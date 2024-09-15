<?php

use App\Livewire\Admin\PermitworkList;
use App\Livewire\Admin\TopicList;
use App\Livewire\Admin\UsersList;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Pemohon\AppreqCreate;
use App\Livewire\Pemohon\AppreqDetail;
use App\Livewire\Pemohon\AppreqList;
use App\Livewire\Resetpass;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/test/page', function () {
    dd(phpinfo());
});

Route::get('login', Login::class)->name('login');
Route::get('reset', Resetpass::class)->name('resetpass');
Route::get('/', UsersList::class)->name('users.list');
Route::get('users', UsersList::class)->name('users.list');
Route::get('permitworks', PermitworkList::class)->name('permitworks.list');
Route::get('topics', TopicList::class)->name('topics.list');
Route::get('permohonan', AppreqCreate::class)->name('appreq.create');
Route::get('permohonan/list', AppreqList::class)->name('appreq.list');
Route::get('permohonan/{id}', AppreqDetail::class)->name('appreq.detail');
// Route::get('dashboard', Dashboard::class)->name('dashboard');
