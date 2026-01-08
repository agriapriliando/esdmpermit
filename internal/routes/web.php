<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Middleware\CekIdPerusahaan;
use App\Http\Middleware\CekApiAuth;
use App\Livewire\CetakProfil;
use App\Livewire\DaftarPerusahaan;
use App\Livewire\ExportProfiles;
use App\Livewire\Profile\Bbc;
use App\Livewire\Profile\Handak;
use App\Livewire\Profile\Iui;
use App\Livewire\Profile\Iuran;
use App\Livewire\Profile\Kim;
use App\Livewire\Profile\Ktt;
use App\Livewire\Profile\Le;
use App\Livewire\Profile\Pa;
use App\Livewire\Profile\Pelabuhan;
use App\Livewire\Profile\Pelaporan;
use App\Livewire\Profile\Pl;
use App\Livewire\Profile\Profile;
use App\Livewire\Profile\ProfileAdd;
use App\Livewire\Profile\Reportmonth;
use App\Livewire\Profile\Rippm;
use App\Livewire\Profile\RippmDetail;
use App\Livewire\Profile\Rkabop;
use App\Livewire\Profile\RkabopPeralatan;
use App\Livewire\Profile\Rpt;
use App\Livewire\Profile\Rr;
use App\Livewire\Profile\Sipbrp;
use App\Livewire\Profile\Sipbrtp;
use App\Livewire\Profile\Stk;
use App\Livewire\Profile\Surat;
use App\Livewire\Profile\Tb;
use App\Livewire\Profile\Triwulan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/internal/home');
});

Route::get('/profiles/view', ExportProfiles::class)->name('exports.view');
Route::get('/profiles/export', function () {
    return view('exports.profiles');
})->name('profiles.export');

Route::get('/login', [AuthApiController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthApiController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('auth.logout');

Route::middleware([CekIdPerusahaan::class, CekApiAuth::class])->group(function () {
    Route::get('/home', DaftarPerusahaan::class)->name('home')->withoutMiddleware([CekIdPerusahaan::class]);
    Route::get('/profile/{id}/cetak', CetakProfil::class)->name('profile.cetak')->withoutMiddleware([CekIdPerusahaan::class]);

    Route::get('/profile/create', ProfileAdd::class)->name('profile.create')->withoutMiddleware([CekIdPerusahaan::class]);;
    Route::get('/profile/{id}', Profile::class)->name('profile.show')->withoutMiddleware([CekIdPerusahaan::class]);;
    Route::get('/iuran', Iuran::class)->name('iuran.show'); // iuran tetap tahunan
    Route::get('/iui', Iui::class)->name('iui.show'); // izin usaha industri
    Route::get('/ktt', Ktt::class)->name('ktt.show');  // kepala teknik tambang
    Route::get('/kim', Kim::class)->name('kim.show'); // kartu izin meledakan
    Route::get('/handak', Handak::class)->name('handak.show'); // gudang handak
    Route::get('/bbc', Bbc::class)->name('bbc.show'); // tangki BBC
    Route::get('/le', Le::class)->name('le.show'); // laporan eksplorasi
    Route::get('/pelabuhan', Pelabuhan::class)->name('pelabuhan.show'); // pelabuhan
    Route::get('/pl', Pl::class)->name('pl.show'); // persetujuan lingkungan
    Route::get('/pa', Pa::class)->name('pa.show'); // project area
    Route::get('/rpt', Rpt::class)->name('rpt.show'); // rencana pascatambang
    Route::get('/rr', Rr::class)->name('rr.show'); // rencana reklamasi
    Route::get('/stk', Stk::class)->name('stk.show'); // studi kelayakan IUP dan SIPB juga
    Route::get('/tb', Tb::class)->name('tb.show'); // tanda batas
    Route::get('/reportmonth', Reportmonth::class)->name('reportmonth.show'); // laporan bulanan
    Route::get('/triwulan', Triwulan::class)->name('triwulan.show'); // laporan triwulan
    Route::get('/surat', Surat::class)->name('surat.show'); // surat masuk keluar

    Route::get('/rippm', Rippm::class)->name('rippm.show');
    Route::get('/rippmdetail/{id}', RippmDetail::class)->name('rippm.detail.show');
    Route::get('/rkabop', Rkabop::class)->name('rkabop.show');
    Route::get('/rkabopperalatan/{id}', RkabopPeralatan::class)->name('rkabop.peralatan.show');
    Route::get('/sipbrp', Sipbrp::class)->name('sipbrp.show');
    Route::get('/sipbrtp', Sipbrtp::class)->name('sipbrtp.show');
    Route::get('/pelaporan', Pelaporan::class)->name('pelaporan.show');
});
