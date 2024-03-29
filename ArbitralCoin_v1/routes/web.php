<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\FavPairsController;
use App\Http\Controllers\BestPairsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MockupController;
use App\Http\Controllers\WebsocketUpdate;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ImportJsonController;




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



Route::get('/',[FrontController::class,'getHome'])->name('home');
Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login'); //metodo authentication viene chiamato quando creo la form

Route::get('/import-json', [ImportJsonController::class, 'importData']);

Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user/notPayed',[AuthController::class, 'utenteNonPagante'])->name('user.notPayed');
Route::get('/user/registration/success',[AuthController::class, 'registrationSuccess'])->name('user.success');
Route::get('/user/registration', [RegistrationController::class, 'userRegistration'])->name('user.registration');
Route::post('/user/register', [RegistrationController::class, 'registration'])->name('user.register');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/registrationEmailCheck', [RegistrationController::class, 'registrationCheckForEmail']);
Route::get('/registrationUsernameCheck', [RegistrationController::class, 'registrationCheckForUsername']);

//Route per pagamenti
Route::get('error-transaction', [PayPalController::class, 'transactionError'])->name('transactionError');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('/checkMail-transaction', [PayPalController::class, 'checkUserMail']);
Route::post('/renewAbbo-transaction', [PayPalController::class, 'renewAbbo'])->name('renewAbbo');



Route::middleware(['authCustom'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/adminUserList',[AdminController::class,'index'])->name('adminUserList.index');
        Route::delete('/adminUserList/{user}',[AdminController::class,'destroy'])->name('adminUserList.destroy');
        Route::get('/adminUserList/{user}/destroy/confirm', [AdminController::class, 'confirmDestroy'])->name('adminUserList.destroy.confirm');
        Route::get('/ajaxUpdateUserTable',[AdminController::class,'updateTable']);
        Route::get('/adminUserList/addUser',[AdminController::class,'createNewUser'])->name('adminUserList.addUser');
        Route::post('/adminUserList',[AdminController::class,'store'])->name('adminUserList.store');
        Route::get('/adminUserList/registerAssistance',[RegistrationController::class,'adminSubAssistance'])->name('adminUserList.register');
        Route::post('/adminUserList/AddUser',[RegistrationController::class,'adminAddUser'])->name('adminUserList.addUser');

        Route::get('/adminMockup',[MockupController::class,'index'])->name('adminMockup.index');
        Route::delete('/adminMockup/{pair}',[MockupController::class,'destroy'])->name('adminMockup.destroy');
        Route::get('/adminMockup/{pair}/destroy/confirm', [MockupController::class, 'confirmDestroy'])->name('adminMockup.destroy.confirm');
        Route::get('/adminMockup/all/destroying/confirm', [MockupController::class, 'confirmDestroyAll'])->name('adminMockup.destroyAll.confirmation');
        Route::delete('/adminMockup/all/destroy', [MockupController::class, 'destroyAll'])->name('adminMockup.destroyAll');
        Route::get('/adminMockup/addElement',[MockupController::class,'createNewElement'])->name('administrator.addNewMockup');
        Route::post('/adminMockup',[MockupController::class,'store'])->name('adminMockup.store');
        Route::get('/adminMockup/{pair}/edit',[MockupController::class,'edit'])->name('adminMockup.edit');
        Route::put('/adminMockup/{pair}',[MockupController::class,'update'])->name('adminMockup.update');
        Route::get('/adminMockupCheck', [MockupController::class, 'adminMockupCheckForPair']);
        
        
        });


Route::get('/privateSection',[TableController::class,'index'])->name('privateSection.index');
Route::get('/ajaxUpdateTable',[TableController::class,'ajaxUpdate']);
Route::get('/ajaxCheckUpdate',[TableController::class,'ajaxCheckUpdate']);
Route::get('/ajaxStoreSettings',[TableController::class,'storeSettings']);

Route::resource('preferenceSettings',PreferencesController::class);
Route::get('/preferencesSettings',[PreferencesController::class,'index'])->name('preferenceSettings.index');
Route::post('/preferenceSettings',[PreferencesController::class,'store'])->name('preferenceSettings.store');

Route::get('/bestPairs',[BestPairsController::class,'index'])->name('bestPairs.index');
Route::get('/ajaxUpdateBestPairs',[BestPairsController::class,'ajaxGetBest']);

Route::get('/favPairs',[FavPairsController::class,'index'])->name('favPairs.index');
Route::post('/favPairs',[FavPairsController::class,'store'])->name('favPairs.store');
Route::delete('/favPairs/{favPair}',[FavPairsController::class,'destroy'])->name('favPairs.destroy');
Route::get('/favPairs/{pair}/destroy/confirm', [FavPairsController::class, 'confirmDestroy'])->name('favPairs.destroy.confirm');
Route::get('/ajaxGetFavList',[FavPairsController::class,'ajaxGetFavList']);
Route::get('/favPairsCheckPair', [FavPairsController::class, 'favPairCheckForPair']);

Route::get('/ajaxPairAssistant',[FavPairsController::class,'ajaxInputAssistant']);
Route::get('/adminAccessError',[AdminController::class,'adminAccessError'])->name('admin.loginError');
//Route::post('/pairTable/updateIsDone', WebsocketUpdate::class)->name('pair.updateDone');




});


