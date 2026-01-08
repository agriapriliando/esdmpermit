<?php

namespace App\Http\Controllers;

use App\Exports\ProfilesExport;
use App\Models\Profile;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EprofileController extends Controller
{
    public function index()
    {
        return view('exports.profiles', [
            'pilihan' => [
                'Profile',
                'Iuran Tetap Tahunan',
                'Izin Usaha Industri (IUI)',
                'Kepala Teknik Tambang (KTT)',
                'Kartu Izin Meledakan (KIM)',
                'Gudang Bahan Peledak',
                'Tangki BBC',
                'Laporan Eksplorasi',
                'Pelabuhan',
                'Persetujuan Lingkungan (PKPLH/SKKL)',
                'Project Area',
                'Rencana Pascatambang RPT',
                'Rencana Penambangan',
                'Rencana Reklamasi RR',
                'Rencana Teknis Penambangan',
                'RIPPM',
                'RKAB Eksplorasi',
                'RKAB Operasi Produksi',
                'Studi Kelayakan (Persetujuan Tekno-Ekonomi)',
                'Tanda Batas',
            ],
            'komoditas' => Profile::select('komoditas')->distinct()->pluck('komoditas', 'komoditas'),
        ]);
    }
    public function export(Request $request)
    {
        // Kolom dipilih user (misal dari checkbox di form)
        $columns = $request->input('columns', [
            'nama_pemegang_perizinan',
            'komoditas',
            'jenis_izin',
        ]);

        // Filter komoditas
        $komoditas = $request->input('komoditas');

        return Excel::download(new ProfilesExport($columns, $komoditas), 'profiles.xlsx');
    }
}
