<?php

use App\Livewire\Admin\AdminAppreqdetail;
use App\Livewire\Admin\AdminAppreqlist;
use App\Livewire\Admin\CompanyList;
use App\Livewire\Admin\PermitworkList;
use App\Livewire\Admin\TopicList;
use App\Livewire\Admin\UsersList;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Pemohon\AppreqCreate;
use App\Livewire\Pemohon\AppreqDetail;
use App\Livewire\Pemohon\AppreqList;
use App\Livewire\Pemohon\Profile;
use App\Livewire\Resetpass;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/test/page', function () {
    dd(phpinfo());
});

Route::get('login', Login::class)->name('login');
Route::get('logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
Route::get('admin/company', CompanyList::class)->name('company.list');
Route::get('reset', Resetpass::class)->name('resetpass');
Route::middleware(['auth'])->group(function () {
    Route::get('/', Profile::class)->name('profile');
    Route::get('profile', Profile::class)->name('profile');
    Route::middleware('cekrole:admin')->group(function () {
        Route::get('admin/{name_stat}', AdminAppreqlist::class)->name('admin.appreq');
        Route::get('admin/appreqdetail/{appreq}', AdminAppreqdetail::class)->name('admin.appreqdetail');
        Route::get('users', UsersList::class)->name('users.list');
        Route::get('permitworks', PermitworkList::class)->name('permitworks.list');
        Route::get('topics', TopicList::class)->name('topics.list');
    });
    Route::middleware('cekrole:pemohon')->group(function () {
        Route::get('permohonan', AppreqCreate::class)->name('appreq.create');
        Route::get('permohonan/list', AppreqList::class)->name('appreq.list');
        Route::get('permohonan/{appreq}', AppreqDetail::class)->name('appreq.detail');
    });
});
// Route::get('dashboard', Dashboard::class)->name('dashboard');
