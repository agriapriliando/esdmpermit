<?php

use App\Livewire\Admin\AdminAppreqdetail;
use App\Livewire\Admin\AdminAppreqlist;
use App\Livewire\Admin\AdminProfile;
use App\Livewire\Admin\PermitworkList;
use App\Livewire\Admin\UserCreate;
use App\Livewire\Admin\UserEdit;
use App\Livewire\Admin\UsersList;
use App\Livewire\Admin\UseradminEdit;
use App\Livewire\Login;
use App\Livewire\Pemohon\AppreqCreate;
use App\Livewire\Pemohon\AppreqDetail;
use App\Livewire\Pemohon\AppreqList;
use App\Livewire\Pemohon\Profile;
use App\Livewire\Resetpass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/test/page', function () {
    dd(phpinfo());
});

Route::get('/datawilayah', function () {
    if (($open = fopen("data_wilayah.csv", "r")) !== false) {
        while (($data = fgetcsv($open, 100000, ",")) !== false) {
            $array[] = $data;
        }
        fclose($open);
    }
    $i = 0;
    $data = [];
    for ($i; $i < count($array); $i++) {
        if (substr($array[$i][0], 0, 2) == "62") {

            if (strlen($array[$i][0]) == 2) {
                $data[$i] = [
                    'id' => $array[$i][0],
                    'name_region' => $array[$i][1],
                    'parent_region' => 0,
                    'type_region' => 'Provinsi',
                    'level_region' => 1,
                ];
            } elseif (strlen($array[$i][0]) == 5) {
                if (substr($array[$i][1], 0, 4) == "KOTA") {
                    $data[$i] = [
                        'id' => $array[$i][0],
                        'name_region' => $array[$i][1],
                        'parent_region' => substr($array[$i][0], 0, 2),
                        'type_region' => 'Kota',
                        'level_region' => 2,
                    ];
                } else {
                    $data[$i] = [
                        'id' => $array[$i][0],
                        'name_region' => $array[$i][1],
                        'parent_region' => substr($array[$i][0], 0, 2),
                        'type_region' => 'Kabupaten',
                        'level_region' => 2,
                    ];
                }
            } elseif (strlen($array[$i][0]) == 8) {
                $data[$i] = [
                    'id' => $array[$i][0],
                    'name_region' => $array[$i][1],
                    'parent_region' => substr($array[$i][0], 0, 5),
                    'type_region' => 'Kecamatan',
                    'level_region' => 3,
                ];
            } elseif (strlen($array[$i][0]) == 13) {
                $data[$i] = [
                    'id' => $array[$i][0],
                    'name_region' => $array[$i][1],
                    'parent_region' => substr($array[$i][0], 0, 8),
                    'type_region' => 'Kelurahan',
                    'level_region' => 4,
                ];
            }
        }
    }
    // print_r($data[0]);
    $data = json_encode($data);
    $outputFile = "wilayah.json";
    // memasukan style ke output
    unlink($outputFile);
    file_put_contents($outputFile, $data,  FILE_APPEND);
});

Route::get('/', Login::class)->name('login');
Route::get('login', Login::class)->name('login');
Route::get('logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
Route::get('reset', Resetpass::class)->name('resetpass');
Route::middleware(['auth'])->group(function () {
    Route::middleware(['cekrole:admin|superadmin|disposisi'])->group(function () {
        Route::get('profile/admin', AdminProfile::class)->name('admin.profile');
        Route::get('profile/admin/{id_user}', UseradminEdit::class)->name('admin.edit');
        Route::get('admin/{name_stat}', AdminAppreqlist::class)->name('admin.appreq');
        Route::get('admin/appreqdetail/{appreq}', AdminAppreqdetail::class)->name('admin.appreqdetail');
        Route::get('users', UsersList::class)->name('users.list');
        Route::get('users/edit/{id_user}', UserEdit::class)->name('user.edit');
        Route::get('users/create', UserCreate::class)->name('user.create');
        Route::get('permitworks', PermitworkList::class)->name('permitworks.list');
    });
    Route::middleware('cekrole:pemohon')->group(function () {
        Route::get('profile', Profile::class)->name('profile');
        Route::get('create/', AppreqCreate::class)->name('appreq.create');
        Route::get('pengajuan/{jenis}', AppreqList::class)->name('appreq.list');
        Route::get('pengajuan/detail/{ver_code}', AppreqDetail::class)->name('appreq.detail');
    });
});
// Route::get('dashboard', Dashboard::class)->name('dashboard');
