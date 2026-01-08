<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class ProfilesExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $selectedColumns;
    protected $mapping;
    protected $selectedPerusahaan;

    public function __construct($selectedColumns, $mapping, $selectedPerusahaan = [])
    {
        $this->selectedColumns = $selectedColumns;
        $this->mapping = $mapping;
        $this->selectedPerusahaan = $selectedPerusahaan;
    }

    public function collection()
    {
        // kumpulkan relasi apa saja yang dipilih
        $relations = [];
        foreach ($this->selectedColumns as $pil) {
            if (!isset($this->mapping[$pil]) || $this->mapping[$pil]['type'] !== 'relation') {
                continue;
            }

            $rel = $this->mapping[$pil]['relation'];

            // === kalau RIPPM Detail → nested eager load
            if ($rel === 'latestRippmDetails') {
                $relations[] = 'latestRippm.details';
            }
            // === kalau RKABOP Peralatan → nested eager load
            elseif ($rel === 'latestRkabopPeralatans') {
                $relations[] = 'latestRkabop.peralatans';
            }
            // === default (hasOne / hasMany langsung)
            else {
                $relations[] = $rel;
            }
        }

        // hilangkan duplikat relasi biar query lebih efisien
        $relations = array_unique($relations);

        // eager load relasi
        $profiles = Profile::with($relations)->get();

        if (!empty($this->selectedPerusahaan)) {
            $profiles = $profiles->whereIn('nama_pemegang_perizinan', $this->selectedPerusahaan);
        }

        return $profiles->values()->map(function ($profile, $index) {
            $row = [];

            // kolom wajib selalu ada
            $row['nomor'] = $index + 1; // nomor urut mulai dari 1
            $row['nama_pemegang_perizinan'] = $profile->nama_pemegang_perizinan ?? null;

            foreach ($this->selectedColumns as $pil) {
                if (!isset($this->mapping[$pil])) {
                    continue;
                }

                $map = $this->mapping[$pil];

                // ambil data dari Profile langsung
                if ($map['type'] === 'model') {
                    foreach ($map['columns'] as $col) {
                        $value = $profile->$col ?? null;

                        // jika kolom tanggal/tgl → format Y-m-d
                        if ($value && (str_contains(strtolower($col), 'tanggal') || str_contains(strtolower($col), 'tgl'))) {
                            $value = \Carbon\Carbon::parse($value)->toDateString();
                        }

                        $row[$pil . '_' . $col] = $value;
                    }
                }

                // ambil data dari relasi
                if ($map['type'] === 'relation') {
                    $rel = $map['relation'];

                    // === khusus untuk latestRippmDetails ===
                    if ($rel === 'latestRippmDetails') {
                        $details = $profile->latestRippm
                            ? $profile->latestRippm->details
                            : collect();

                        foreach ($map['columns'] as $col) {
                            $value = $details->pluck($col)->implode(', ');
                            $row[$pil . '_' . $col] = $value ?: null;
                        }
                    }
                    // === khusus untuk latestRkabopPeralatans ===
                    elseif ($rel === 'latestRkabopPeralatans') {
                        $peralatans = $profile->latestRkabop
                            ? $profile->latestRkabop->peralatans
                            : collect();

                        foreach ($map['columns'] as $col) {
                            $value = $peralatans->pluck($col)->implode(', ');
                            $row[$pil . '_' . $col] = $value ?: null;
                        }
                    }
                    // === kalau relasi hasMany biasa ===
                    elseif ($profile->$rel instanceof \Illuminate\Support\Collection) {
                        foreach ($map['columns'] as $col) {
                            $value = $profile->$rel->pluck($col)->implode(', ');
                            $row[$pil . '_' . $col] = $value ?: null;
                        }
                    }
                    // === kalau relasi hasOne / belongsTo ===
                    else {
                        $relationData = $profile->$rel ?? null;
                        foreach ($map['columns'] as $col) {
                            $value = $relationData->$col ?? null;

                            if ($value && (str_contains(strtolower($col), 'tanggal') || str_contains(strtolower($col), 'tgl'))) {
                                $value = \Carbon\Carbon::parse($value)->toDateString();
                            }

                            $row[$pil . '_' . $col] = $value;
                        }
                    }
                }
            }

            return $row;
        });
    }

    public function headings(): array
    {
        $headings = [
            'Nomor',
            'Nama Pemegang Perizinan',
        ];

        foreach ($this->selectedColumns as $pil) {
            if (!isset($this->mapping[$pil])) {
                continue;
            }

            $map = $this->mapping[$pil];
            foreach ($map['columns'] as $col) {
                // $headings[] = strtoupper($pil . ' ' . $col);
                $headings[] = strtoupper($col);
            }
        }

        return $headings;
    }

    // === FORMAT DINAMIS ===
    public function columnFormats(): array
    {
        $formats = [];

        // Ambil semua headings biar tahu urutan kolom
        $headings = $this->headings();

        foreach ($headings as $index => $heading) {
            // Convert index (0,1,2,...) ke huruf kolom (A,B,C,...)
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);

            // Kalau heading mengandung kata 'TANGGAL' → format jadi date
            if (str_contains(strtolower($heading), 'tanggal') || str_contains(strtolower($heading), 'tgl')) {
                $formats[$columnLetter] = 'yyyy-mm-dd'; // lebih aman, karena tahun bisa 4 digit
            }
        }

        return $formats;
    }
}
