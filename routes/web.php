<?php

use App\Http\Controllers\admin\DashController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/' , [PostController::class , 'index']);
Route::resource('/post' , PostController::class);
Route::post('/search' , [PostController::class , 'search'])->name('search');
Route::get('/category/{id}/{slug}' , [PostController::class , 'getByCategory'])->name('category');
Route::resource('/comment' , CommentController::class);
Route::post('/reply/stroe' , [CommentController::class , 'replyStore'])->name('reply.add');
Route::post('/notification' , [NotificationController::class , 'index'])->middleware('auth')->name('notification');
Route::get('/notification' , [NotificationController::class , 'allNotifications'])->name('all.Notification');
Route::get('/user/{id}' , [UserController::class , 'getPostByUser'])->name('profile');
Route::get('/user/{id}/comments' , [UserController::class , 'getCommentByUser'])->name('user_comments');


Route::prefix('admin')->middleware(Admin::class)->group(function() {
    Route::resource('/posts', AdminPostController::class);
    Route::resource('/role', RoleController::class);
    Route::get('/permission', [PermissionController::class , 'index'])->name('permissions');
    Route::post('/permission', [PermissionController::class , 'store'])->name('permissions.store');
    Route::resource('/user', UserController::class);
    Route::resource('/page' , PageController::class);
    
    Route::get('/dashboard', [DashController::class , 'index'])->name('admin.dashboard');
    Route::resource('/category' , CategoryController::class);
});

Route::get('/permissions/by-role', [PermissionController::class, 'getPermissionsByRole'])->name('permission_byRole')->middleware(Admin::class);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
