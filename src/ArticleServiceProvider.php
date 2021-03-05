<?php


namespace Aoeng\Laravel\Admin\Article;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\CKEditor\Editor;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    public function boot(Article $extension)
    {
        if (!Article::boot()) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-article');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes([
                $assets => public_path('vendor/aoeng/laravel-admin-article')
            ], 'laravel-admin-article');
        }

        Admin::booting(function () {
            Form::extend('editor', Editor::class);
        });

    }

}
