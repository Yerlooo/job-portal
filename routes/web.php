<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BuatLowonganController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobProviderController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\KehidupanBudayaController;
use App\Http\Controllers\LamarPekerjaanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\Post;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendEmail;
use App\Http\Controllers\SocialController;
use App\Models\JobVacancy;
use App\Models\Lowker;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;







Route::get('/home', [AuthController::class, 'login'])->name('homee');

// Route::group(['middleware' => ['auth', 'verified']], function() {
//     Route::get('/link-kerjaku', [AuthController::class, 'getLogin']);
// });

// Route::get('/link-kerjaku', function () {
//     return view('Beranda.beranda-after-login');
// })->middleware(['auth', 'verified']);

Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
    Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
    Route::get('redirect', [RedirectController::class, 'cek']);
});

Route::group(['middleware' => ['auth', 'checkrole:2']], function(){
    Route::get('/perusahaan', [PerusahaanController::class, 'getShowHomePagePerusahaan']);

    Route::get('/DetailPerusahaan', [PerusahaanController::class, 'getShowDetailPerusahaan'])->name('detailperusahaan');
    Route::get('/LihatPerusahaan', [PerusahaanController::class, 'getshowLihatPerusahaan'])->name('lihatperusahaan');
    Route::get('/LihatPerusahaan2', [PerusahaanController::class, 'getShowLihatPerusahaan2'])->name('lihatperusahaan2');
    Route::get('/ProfillPerusahaan', [PerusahaanController::class, 'getShowProfillPerusahaan'])->name('profilperusahaan');
    
    
    
});
Route::get('/Kontak-Perusahaan', [PerusahaanController::class, 'getShowKontakPerusahaan'])->name('kontakperusahaan');
Route::post('/Kontak-Perusahaan', [PerusahaanController::class, 'postKontak'])->name('postkontakperusahaan');
Route::get('/HomePagePerusahaan', [PerusahaanController::class, 'getShowHomePagePerusahaan'])->name('HomePagePerusahaan');
Route::post('/BuatLowongan', [JobProviderController::class, 'store'])->name('postbuatlowongan');
Route::post('/BuatLowongan2', [JobProviderController::class, 'storePage'])->name('postbuatlowongan2');
Route::post('/BuatLowongan3', [JobProviderController::class, 'storePageThree'])->name('postbuatlowongan3');

Route::get('/PageLogin-Dashboard', [DashboardController::class, 'getShowLoginDashboard'])->name('loginperusahaan');
Route::get('/PageDashboard', [DashboardController::class, 'getShowDashboardHome'])->middleware('auth')->name('dashboardperusahaan');
Route::get('/PageOverlay-Dashboard', [DashboardController::class, 'getShowOverlay'])->middleware('auth')->name('overlay');
Route::get('/Page-DokumenPelamar', [DashboardController::class, 'getShowDokumen'])->middleware('auth')->name('dokumen');
Route::get('/Page-BuatLowongan', [DashboardController::class, 'getShowCreateLowongan'])->middleware('auth')->name('buatlowongan');
Route::get('/Page-BuatLowongan2', [DashboardController::class, 'getShowCreateLowongan2'])->middleware('auth')->name('buatlowongan2');
Route::get('/Page-BuatLowongan3', [DashboardController::class, 'getShowCreateLowongan3'])->middleware('auth')->name('buatlowongan3');
Route::get('/Page-LihatLowongan', [DashboardController::class, 'getShowLihatLowongan'])->middleware('auth')->name('lihatlowongan');
Route::get('/Page-LowonganKerja', [DashboardController::class, 'getShowPageLowonganKerja'])->middleware('auth')->name('lowongankerjaperusahaan');
Route::get('/Page-Profill', [DashboardController::class, 'getShowProfill'])->name('profilperusahaan');
Route::get('/Page-StatusPelamar', [DashboardController::class, 'getShowStatus'])->name('statuspelamar');
Route::get('/Page-EditProfill', [DashboardController::class, 'getShowEdit'])->name('editprofilperusahaan');
Route::get('/api/job/{jobTitle}', [DashboardController::class, 'getJobData'])->name('jobtitle');

Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('/link-Kerjaku', [LoginController::class, 'userAfterLogin'])->middleware('auth')->name('homelogin');
    
    Route::get('/ProfillPelamar', [PelamarController::class, 'getShowProfillPelamar'])->name('profilpelamar');
    Route::get('/HomePagePelamar', [PelamarController::class, 'getShowHomePagePelamar'])->name('HomePagePelamar');
    
    Route::resource('applications', ApplicationController::class);
});
Route::get('/resultLamar', [LamarPekerjaanController::class, 'resultLamar'])->middleware('auth')->name('resultlamar');

// Route::get('/link-kerjaku', function () {
//     return view('Beranda.beranda-after-login');
// })->middleware('auth')->name('homelogin');


Route::get('/LamarPekerjaan', [LowonganKerjaController::class, 'getShowLamarKerja'])->name('lamarpekerjaan');
Route::get('/LamarPekerjaan2', [LowonganKerjaController::class, 'getShowLamarKerjaa'])->name('lamarpekerjaan2');
Route::get('/LamarPekerjaan3', [LowonganKerjaController::class, 'getShowLamarKerjaaa'])->name('lamarpekerjaan3');
Route::post('/LamarPekerjaan', [LamarPekerjaanController::class, 'postDescriptions'])->name('postlamarpekerjaan');
Route::post('/LamarPekerjaan2', [LamarPekerjaanController::class, 'postLocations'])->name('postlamarpekerjaan2');
Route::post('/LamarPekerjaan3', [LamarPekerjaanController::class, 'postMoreInfor'])->name('postlamarpekerjaan3');

Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');

Route::get('auth/redirect/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('facebook/redirect', [FacebookController::class, 'handleFacebookCallback'])->name('facebook.callback');

Route::get('/', function(){return view('Beranda.beranda',[]);});

// login
Route::get('/login', [LoginController::class, 'getShowLogin'])->name('login');
Route::post('/login', [LoginController::class, 'getAuthenticateLogin'])->name('postlogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('loginperusahaan', [LoginController::class, 'getAuthenticateLogin'])->name('postloginperusahaan');

//register
Route::get('/register', [RegisterController::class, 'getShowRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'getStoreRegister'])->name('postregister');
Route::post('/registerperusahaan', [RegisterController::class, 'getStoreRegisterPerusahaan'])->name('postregisterperusahaan');

// Route::get('/lowongan/{id}', [JobProviderController::class, 'show']);
Route::get('/lowongan-kerja', [JobController::class, 'index'])->name('lowongankerja');

Route::get('/result', [JobProviderController::class, 'result'])->name('result');
Route::get('/lowongankerja', [LowonganKerjaController::class, 'getShowLowonganKerja'])->name('lowongankerja');
Route::get('/lowongankerja2', [LowonganKerjaController::class, 'getShowLowonganKerjaa'])->name('lowongankerja2');
Route::get('/unggahlowongan', [LowonganKerjaController::class, 'getShowUnggahLowongan'])->name('unggahlowongan');
Route::get('/lowongandisimpan', [LowonganKerjaController::class, 'saveLowongan'])->name('lowongandisimpan');
Route::get('/DetailPekerjaan', [LowonganKerjaController::class, 'getShowDetailKerja'])->name('detailpekerjaan');

//about
Route::get('/about', [AboutController::class, 'getShowAboutt'])->name('about');
Route::get('/about2', [AboutController::class, 'getShowAbout']);
Route::get('/aboutperusahaan', [AboutController::class, 'getShowAboutPerusahaan'])->name('aboutperusahaan');

//blog
Route::get('/detailblog', [BlogController::class, 'getDetailBlog'])->name('detailblog');
Route::get('/detailblog2', [BlogController::class, 'getDetailSecBlog'])->name('detailblog2');
Route::get('/detailblog3', [BlogController::class, 'getDetailThirdBlog']);
Route::post('/detailblog', [BlogController::class, 'postBlog'])->name('postdetailblog');
Route::get('/kehidupanbudaya', [KehidupanBudayaController::class, 'getShowKB'])->name('kehidupanbudaya');

Route::get('/PopUpStatus', function () {return view('PopUpStatus', ["title" => "PopUpStatus"]);});

Route::get('/disimpan', function () {return view('disimpan', ["title" => "saved"]);});

// RESET PASSWORD
Route::get('/forgot-password', function () {return view('auth.forgot-password');})->middleware('guest')->name('password.request');

Route::get('/kontak', [ContactController::class, 'getShowContact']);

Route::get('/send-newsletter', [SendEmail::class, 'sendNewsLetter']);
Route::get('/email-verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/link-kerjaku');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::resource('job-seekers', JobSeekerController::class);
Route::resource('job-providers', JobProviderController::class);
Route::get('/edit/{id}', [JobController::class,'edit'])->name('jobs.edit');
Route::put('job/{id}', [JobController::class, 'update'])->name('job.update');
Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
// Route::resource('jobs', JobController::class);
// Route::resource('applications', ApplicationController::class);

Route::get('/findjob', function(){return view('findjob',[]);});
Route::get('/search', [JobProviderController::class, 'search'])->name('search');
Route::get('/apply/{job}', [JobApplicationController::class, 'create'])->name('apply.create');
Route::post('/apply', [JobApplicationController::class, 'store'])->name('apply.store');

Route::get('/daftar-perusahaan', [DashboardController::class, 'getShowRegisterDashboard'])->name('daftar-perusahaan');