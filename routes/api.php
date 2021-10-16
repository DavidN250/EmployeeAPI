<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('employees',EmployeeController::class);
// Route::get('/employees/search/{keyword}',[EmployeeController::class,'search']);

// Route::get('/employees',[EmployeeController::class,'index']);
// Route::post('/employees ', [EmployeeController::class,'store']);


// Public routes
//Route::post('/register', [AuthController::class, 'register']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::get('/employees/search/{keyword}', [EmployeeController::class, 'search']);

//Authentication
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);


// Protected routes

Route::group(['middleware'
 => ['auth:sanctum','verified']], function () {
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [ProductController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
    Route::post('/employees/activate/{id}', [EmployeeController::class, 'activate']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

