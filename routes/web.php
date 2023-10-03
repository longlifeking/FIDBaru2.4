<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AFEController;
use App\Http\Controllers\Fidcontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\filecontroller;
use App\Http\Controllers\Bookscontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\flowlinecontroller;
use App\Http\Controllers\Penggunacontroller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuangLingkupController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AFEControllerPengunjung;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('verify-email/{token}',[VerificationController::class,'verify'])->name('verification.verify');
Route::get('/berhasil-verification',[VerificationController::class,'berhasil']);
Route::get('/gagal-verification',[VerificationController::class,'gagal'])->name('gagal-verification');


Route::middleware(['only_Guest'])->group(function () {
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'authenticating'])->name('authentifikasi');
    Route::get('register',[AuthController::class,'register']);
    Route::post('register',[AuthController::class,'registerProcess'])->name('registerprocess');  
});
Route::middleware(['auth'])->group(function () {
    Route::get('logout',[AuthController::class,'logout']);
    //buat notofikasi

    Route::get('dashboard2',[DashboardController::class,'user'])->middleware('only_Pengunjung');
    Route::get('view-fid',[DashboardController::class,'viewfid']);
    Route::get('view-afe',[DashboardController::class,'viewafe']);
    Route::get('view-cor',[DashboardController::class,'viewcor']);
    Route::get('dashboard',[DashboardController::class,'index'])->middleware('only_Admin');
    Route::get('profile',[profilecontroller::class,'index']);
    Route::get('profile1',[profilecontroller::class,'edit']);
    Route::put('profile1/{slug}',[profilecontroller::class,'updateakun'])->name('update.akun');
    Route::get('update-password/{slug}',[profilecontroller::class,'update_password']);
    Route::get('user-password/{slug}',[Penggunacontroller::class,'update_password']);
    Route::put('rubah-user-password/{slug}',[Penggunacontroller::class,'ubahpassword'])->name('user.password');
    Route::put('ubah-password/{slug}',[profilecontroller::class,'ubahpassword'])->name('ubah.password');
    Route::get('books',[Bookscontroller::class,'index']);
    Route::get('not-found',[filecontroller::class,'index']); // membuat file yang tidak ada 
    Route::get('fid',[Fidcontroller::class,'fid'])->name('fid-tampilan');
    Route::get('fid-show/{slug}',[Fidcontroller::class,'show']);
    Route::get('fid-show2/{slug}',[Fidcontroller::class,'show2'])->middleware('only_Pengunjung');
    //Route::get('/afe-awal/search', [AFEController::class, 'search'])->name('afe.search'); tidak jadi dilakukan
    Route::get('afe-show/{slug}',[AFEController::class,'show']);
    Route::get('afe-show2/{slug}',[AFEControllerPengunjung::class,'show']);
    Route::post('/fid',[Fidcontroller::class,'store'])->name('fid.store');

    // Buat Admin Untuk View AFE
    Route::get('/BS/{id}/download', [AFEController::class, 'downloadFileBS'])->name('BS.download')->middleware('only_Admin');
    Route::get('/PS/{id}/download', [AFEController::class, 'downloadFilePS'])->name('PS.download')->middleware('only_Admin');
    Route::get('/PISPPP/{id}/download', [AFEController::class, 'downloadFilePISPPP'])->name('PISPPP.download')->middleware('only_Admin');
    Route::get('/COR/{id}/download', [AFEController::class, 'downloadFileCOR'])->name('COR.download')->middleware('only_Admin');
   

    // Buat Penggunjung Untuk View AFE
    Route::get('/BS/{id}/', [AFEControllerPengunjung::class, 'FileBS'])->name('BS.view')->middleware('only_Pengunjung');
    Route::get('/PS/{id}/', [AFEControllerPengunjung::class, 'FilePS'])->name('PS.view')->middleware('only_Pengunjung');
    Route::get('/PISPPP/{id}/', [AFEControllerPengunjung::class, 'FilePISPPP'])->name('PISPPP.view')->middleware('only_Pengunjung');
    Route::get('/COR/{id}/', [AFEControllerPengunjung::class, 'FileCOR'])->name('COR.view')->middleware('only_Pengunjung');

    Route::get('/bs-view/{id}/', [AFEControllerPengunjung::class, 'viewFileBS'])->name('onlyBS.view')->middleware('only_Pengunjung');
    Route::get('/ps-view/{id}/', [AFEControllerPengunjung::class, 'viewFilePS'])->name('onlyPS.view')->middleware('only_Pengunjung');
    Route::get('/ppp-view/{id}/', [AFEControllerPengunjung::class, 'viewFilePISPPP'])->name('onlyPISPPP.view')->middleware('only_Pengunjung');
    Route::get('/cor-view/{id}/', [AFEControllerPengunjung::class, 'viewFileCOR'])->name('onlyCOR.view')->middleware('only_Pengunjung');


    // Buat Admin Untuk Download FID DAN POD
    Route::get('/fid/{id}/', [Fidcontroller::class, 'downloadFile'])->name('fid.download')->middleware('only_Admin');
    Route::get('/POD/{id}/', [Fidcontroller::class, 'downloadPod'])->name('pod.download')->middleware('only_Admin');

    // Buat Penggunjung Untuk View FID DAN POD
    Route::get('/fid2/{id}/', [Fidcontroller::class, 'viewFile'])->name('fid.view');
    Route::get('/POD2/{id}/', [Fidcontroller::class, 'viewPod'])->name('pod.view');
    Route::get('/fid-view/{id}',[Fidcontroller::class, 'onlyviewFile'])->name('fidpdf.view');
    Route::get('/pod-view/{id}',[Fidcontroller::class, 'onlyviewFilePODP'])->name('podpdf.view');

    Route::get('/fid-search',[Fidcontroller::class,'tampilansearch']);
    Route::get('/fid/search', [Fidcontroller::class, 'search'])->name('fid.search');
    Route::get('fid-edit/{slug}',[Fidcontroller::class,'edit']);
    Route::put('fid-edit/{slug}', [Fidcontroller::class,'update'])->name('fid.update');
    Route::get('fid-hapus/{slug}',[Fidcontroller::class,'hapus'])->name('fid.hapus');
    Route::delete('fid-Destroy/{slug}',[Fidcontroller::class,'Destroy'])->name('fid.Destroy');
    Route::get('/afe-awal', [AFEController::class, 'awal'])->middleware('only_Admin');
    Route::get('/afe-awal1', [AFEControllerPengunjung::class, 'awal']);
    Route::get('/afe-showrl/{id}', [AFEController::class, 'showrl']);
    Route::get('/afe-showrl1/{id}', [AFEControllerPengunjung::class,'showrl']);
    Route::get('/afe', [AFEController::class, 'showMatchingData'])->name('afe.index');
    //Route::get('/afe', [AFEController::class, 'search'])->name('afe.search');
    Route::get('/getRuangLingkup/{id}', [AFEController::class,'getRuangLingkup']);
    Route::post('/afe',[AFEController::class,'store'])->name('afe.store');
    Route::put('afe-edit/{slug}', [AFEController::class,'update'])->name('afe.update');
    Route::get('afe-hapus/{slug}',[AFEController::class,'hapus'])->name('afe.hapus');
    Route::delete('afe-destroy/{slug}',[AFEController::class,'Destroy'])->name('afe.Destroy');
    Route::get('afe-edit/{slug}',[AFEController::class,'edit']);
    Route::get('Pengguna',[Penggunacontroller::class,'pengguna']);
    Route::get('Pengguna-edit/{slug}',[Penggunacontroller::class,'edit']);
    Route::put('Pengguna-edit/{slug}', [Penggunacontroller::class,'update'])->name('Pengguna.update');
    Route::get('Pengguna-Hapus/{slug}', [Penggunacontroller::class,'delete'])->name('Pengguna.hapus');
    Route::delete('Pengguna-Destroy/{slug}', [Penggunacontroller::class,'destroy']);
    // route untuk flowline
    Route::get('flowline',[flowlinecontroller::class,'index']);
    Route::get('flowline_tambah',[flowlinecontroller::class,'tambah'])->name('tambah');
    Route::post('flowline_tambah',[flowlinecontroller::class,'store'])->name('flowline.store');
    Route::get('flowline-hapus/{slug}',[flowlinecontroller::class,'hapus'])->name('flowline.hapus');
    Route::delete('flowline-destroy/{slug}',[flowlinecontroller::class,'Destroy'])->name('afe.Destroy');
    Route::get('flowline-edit/{slug}',[flowlinecontroller::class,'edit'])->name('flowline.edit');
    Route::put('flowline-edit/{slug}',[flowlinecontroller::class,'update'])->name('flowline.update');
    Route::get('flowline-show/{slug}',[flowlinecontroller::class,'show'])->name('flowline.show');
    Route::get('viewjambi-flowline',[flowlinecontroller::class,'viewjambi1']);
    Route::get('viewjambiHarga-flowline',[flowlinecontroller::class,'Hargajambi1']);
    Route::get('viewsiak-flowline',[flowlinecontroller::class,'viewsiak1']);
    Route::get('viewsiakHarga-flowline',[flowlinecontroller::class,'Hargasiak1']);
    Route::get('viewpangsu-flowline',[flowlinecontroller::class,'viewpangsu1']);
    Route::get('viewpangsuHarga-flowline',[flowlinecontroller::class,'Hargapangsu1']);
    Route::get('viewrantau-flowline',[flowlinecontroller::class,'viewrantau1']);
    Route::get('viewrantauHarga-flowline',[flowlinecontroller::class,'Hargarantau1']);
    // buat notifikasi 
    Route::get('view-notification',[RegisterController::class,'registered'])->name('notification.nav');

});
