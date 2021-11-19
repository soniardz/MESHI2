<?php

use Illuminate\Support\Facades\Route;


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
//use App\Models\Image;

Route::get('/', function () {
  /*  
    $images = Image::all();
    foreach($images as $image){
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name.' '.$image->user->surname. "<br/>";
        
        if (count($image->comments)){
        echo '<strong>Comentarios: </strong>';
        foreach($image->comments as $comment){
            echo $comment->user->name.' '.$comment->user->surname.': ';
            echo $comment->content;
        }
        }
        
        echo "<br/>".'LIKES: '.count($image->likes); 
        echo "<hr/>";
    }*/
    
});

//General
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Usuario
Route::get('/configuracion', 'App\Http\Controllers\UserController@config')->name('config');
Route::post('/user/update', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::get('/gente/{search?}', 'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('/users/avatar/{filename}', 'App\Http\Controllers\UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');

//imagen
Route::get('subir-image', 'App\Http\Controllers\ImageController@create')->name('image.create');
Route::post('/image/save', 'App\Http\Controllers\ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image.file');
Route::get('/image/{id}', 'App\Http\Controllers\ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'App\Http\Controllers\ImageController@delete')->name('image.delete');
Route::get('/image/editar/{id}', 'App\Http\Controllers\ImageController@edit')->name('image.edit');
Route::post('/image/update', 'App\Http\Controllers\ImageController@update')->name('image.update');

//comentarios
Route::post('/comment/save', 'App\Http\Controllers\CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'App\Http\Controllers\CommentController@delete')->name('comment.delete');
Route::get('/like/{image_id}', 'App\Http\Controllers\LikeController@like')->name('like.save');

//like
Route::get('/dislike/{image_id}', 'App\Http\Controllers\LikeController@dislike')->name('like.delete');
Route::get('/likes', 'App\Http\Controllers\LikeController@index')->name('likes');


