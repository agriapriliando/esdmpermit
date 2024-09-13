<?php

use App\Livewire\Admin\PermitworkList;
use App\Livewire\Admin\UsersList;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Resetpass;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', Login::class)->name('login');
Route::get('reset', Resetpass::class)->name('resetpass');
Route::get('users', UsersList::class)->name('users.list');
Route::get('permitworks', PermitworkList::class)->name('permitworks.list');
// Route::get('dashboard', Dashboard::class)->name('dashboard');
