<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

// Route::get('/test', function () {
//     dd()
// });


Route::get('/', function () {
    return view('landing');
})->name('home');


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'loginUser']);

Route::get('/register',[RegisterController::class,'create'])->name('register');
Route::post('/register',[RegisterController::class,'store']);
Route::get('/edit/{user_id}',[RegisterController::class,'edit'])->name('edit.profile');
Route::put('/update/{user_id}',[RegisterController::class,'update'])->name('update.profile');

Route::get('/logout',[LogoutController::class,'logoutUser'])->name('logout');

Route::resource('/competitions',Competitioncontroller::class);
Route::post('/join',[Competitioncontroller::class,'join'])->name('joinCompetition');

Route::resource('/competitions.objectives',ObjectiveController::class)->only(['index','store','edit','update','destroy']);
Route::get('/competitions/{competition_id}/teams/{team_id}/objectives',[ObjectiveController::class,'listAll'])->name('listAllObjectives');

Route::post('/evaluate/{team_id}/objective/{objective_id}',[ObjectiveController::class,'evaluateObjective'])->name('evaluate.objective');

Route::resource('/competitions.teams',TeamController::class)->only('index','store','show');
Route::resource('/team',TeamController::class);

Route::resource('/competitions.evaluators',EvaluatorController::class)->only(['index','store','destroy']);

Route::resource('/competitions.teams.projects',ProjectController::class);
Route::get('/download/{project_id}',[ProjectController::class,'downloadFile'])->name('download.project');
Route::delete('/delete-file/{project_id}',[ProjectController::class,'deleteFile']);



/*
-------------------------------------------------------------------------- 
                        Password reset
--------------------------------------------------------------------------
*/

Route::get('/forgot-password',function(){
    return  view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password',function(Request $request){
    $request->validate([
        'email' => 'required|email',
        'radio' => 'required'
        ]);

    $status = Password::broker($request->radio)->sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT 
    ? back()-> with(['status' => __($status)])
    : back()->withErrors(['email'=>__($status)]);
})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'radio' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $status = Password::broker($request->radio)->reset(
        $request->only('email', 'password', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');



