<?php

namespace App\Providers;

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposer\CategoryComposer;
use App\Http\ViewComposer\RoleComposer;
use App\Http\ViewComposer\CommentComposer;
use App\Http\ViewComposer\PageComposer;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        View::composer(['partials.sidebar', 'lists.categories'], CategoryComposer::class);
        View::composer('lists.roles' ,RoleComposer::class );
        View::composer('partials.sidebar',CommentComposer::class);
        View::composer('partials.navbar',PageComposer::class);
        
        Blade::if('admin' , function(){
            return Auth::check() && auth()->user()->isAdmin();
        });

        // Gate::define('delete-post' , function($user , $post){
        //     return $user->hasAllow('delete-post') && ($user->id == $post->user_id) || $user->isAdmin();
        // });


        // Gate::define('edit-post' , function($user , $post){
        //     return $user->hasAllow('edit-post') && ($user->id == $post->user_id) || $user->isAdmin();
        // });
        

        // هلقيت بمر على كل الصلاحيات وبعرف شو الصلاحية الموجودة وبفعلو
        // Permission::get(['name'])->map(function($per){
        //     Gate::define($per->name , function($user , $post) use ($per){
        //         return $user->hasAllow($per->name) && ($user->id == $post->user_id) || $user->isAdmin();
        //     });
        // });


        // Permission::whereIn('name' , ['edit-post' , 'add-post' , 'delete-post'])->get()->map(function($per){
        //     Gate::define($per->name , function($user , $post) use ($per){
        //         return $user->hasAllow($per->name) && ($user->id == $post->user_id) || $user->isAdmin();
        //     });
        // });

        // Permission::whereIn('name' , ['edit-user' , 'add-user' , 'delete-user'])->get()->map(function($per){
        //     Gate::define($per->name , function($user) use ($per){
        //         return $user->hasAllow($per->name) && $user->isAdmin();
        //     });
        // });


        if (Schema::hasTable('permissions')) {
            Permission::whereIn('name', ['edit-post', 'add-post', 'delete-post'])->get()->map(function ($per) {
                Gate::define($per->name, function ($user, $post) use ($per) {
                    return $user->hasAllow($per->name) && ($user->id == $post->user_id) || $user->isAdmin();
                });
            });
        
            Permission::whereIn('name', ['edit-user', 'add-user', 'delete-user'])->get()->map(function ($per) {
                Gate::define($per->name, function ($user) use ($per) {
                    return $user->hasAllow($per->name) && $user->isAdmin();
                });
            });
        }


        
    }
}
