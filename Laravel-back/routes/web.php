<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\AuthenticationController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionLineController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('organisations', OrganisationController::class)->middleware('auth');
Route::resource('organisations/{organisation}/missions', MissionController::class)->middleware('auth');
Route::post('mission-lines', [MissionLineController::class, 'store'])->name('mission.create')->middleware('auth');

// connexion github

Route::get('/users', function () {
    return [
      'user_connected' => Auth::user(),
      'users' => User::all()
    ];
  });

Route::get('/login/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $databaseUser = User::query()->firstOrNew(['email' => $githubUser->getEmail()]);

    $databaseUser
      ->fill([
        'name' => $githubUser->getName() ?? $githubUser->getNickname(),
        'avatar_url' => $githubUser->getAvatar()
      ])
      ->save();

    Auth::login($databaseUser);

    return redirect('/');
  });
  Route::get('/logout', function () {
    Auth::logout();

    return redirect('/');
  });
