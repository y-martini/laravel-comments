<?php
namespace YuriyMartini\Comments;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use YuriyMartini\Comments\Contracts\Comment as CommentContract;
use YuriyMartini\Comments\Contracts\Commentator;
use YuriyMartini\Comments\Models\Comment;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootMigrations();
        $this->bootConfig();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerBindings();
    }

    protected function bootMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => App::databasePath('migrations'),
        ], ['comments', 'migrations', 'comments-migrations']);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/2020_01_01_000000_create_comments_table.php');
    }

    protected function bootConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/comments.php' => App::configPath('comments.php'),
        ], ['comments', 'config', 'comments-config']);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/comments.php', 'comments'
        );
    }

    protected function registerBindings()
    {
        $this->app->bind(CommentContract::class, Comment::class);
        $this->app->bind(Commentator::class, Config::get('comments.commentator_class'));
    }
}
