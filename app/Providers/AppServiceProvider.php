<?php

namespace App\Providers;

use App\Category;
use App\Message;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (!$this->app->runningInConsole()) {

            view()->composer('frontend.partials.footer', function ($view) {
                $view->with('footersettings', Setting::select('footer', 'aboutus', 'facebook', 'twitter', 'linkedin')->get());
            });

            //categories
            view()->share('categories', Category::withCount('posts')->get());

            //recommended posts
            view()->share('recommendedposts', Post::latest()->where('status', 1)->take(3)->get());

            view()->composer('frontend.partials.navbar', function ($view) {
                $view->with('navbarsettings', Setting::select('name')->get());
            });

            view()->composer('backend.partials.navbar', function ($view) {
                $view->with('countmessages', Message::latest()->where('agent_id', Auth::id())->count());
                $view->with('navbarmessages', Message::latest()->where('agent_id', Auth::id())->take(5)->get());
            });

            view()->composer('pages.contact', function ($view) {
                $view->with('contactsettings', Setting::select('phone', 'email', 'address')->get());
            });

            view()->composer('pages.blog.sidebar', function ($view) {

                $archives = Post::archives();
                $categories = Category::has('posts')->withCount('posts')->get();
                $tags = Tag::has('posts')->get();
                $popularposts = Post::orderBy('view_count', 'desc')->take(5)->get();

                $view->with(compact('archives', 'categories', 'tags', 'popularposts'));
            });

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
