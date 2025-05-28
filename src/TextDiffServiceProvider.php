<?php

namespace Juanrube\TextDiff;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Juanrube\TextDiff\Facades\TextDiff as TextDiffFacade;
use Juanrube\TextDiff\View\Components\TextDiffComponent;
use Juanrube\TextDiff\TextDiff;

class TextDiffServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/textdiff.php', 'textdiff'
        );

        $this->app->singleton('textdiff', function ($app) {
            $textdiff = new TextDiff();

            $config = $app['config']->get('textdiff');

            if ($config) {
                if (!empty($config['renderer_name'])) {
                    $textdiff->setRendererName($config['renderer_name']);
                }
                if (!empty($config['differ_options'])) {
                    $textdiff->setDifferOptions($config['differ_options']);
                }
                if (!empty($config['renderer_options'])) {
                    $textdiff->setRendererOptions($config['renderer_options']);
                }
            }

            return $textdiff;
        });
    }

    public function boot()
    {
        // Publicar configuración, CSS, vistas bajo la misma tag "text-diff"
        $this->publishes([
            __DIR__ . '/config/textdiff.php' => config_path('textdiff.php'),
            __DIR__ . '/resources/css/textdiff.css' => public_path('vendor/textdiff/textdiff.css'),
            __DIR__ . '/resources/views/components/diff.blade.php' => resource_path('views/vendor/textdiff/components/text-diff.blade.php'),
        ], 'text-diff');

        // Registrar el componente de Blade
        Blade::component('text-diff', TextDiffComponent::class);

        // View Composer global para $textdiff
        View::composer('*', function ($view) {
            $view->with('textdiff', TextDiff::styleTag());
        });

        // Registrar la vista de componentes
        $this->loadViewsFrom(__DIR__ . '../resources/views', 'textdiff');

        // Registrar la fachada
        $this->app->alias('textdiff', TextDiffFacade::class);

    }
}
