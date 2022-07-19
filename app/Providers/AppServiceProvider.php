<?php

namespace App\Providers;

use App\View\Components\Shdw\Card;
use App\View\Components\Shdw\Forms\Checkbox;
use App\View\Components\Shdw\Forms\File;
use App\View\Components\Shdw\Forms\Input;
use App\View\Components\Shdw\Forms\Search;
use App\View\Components\Shdw\Forms\Select;
use App\View\Components\Shdw\Menues\MegaMenu;
use App\View\Components\TextArea;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::component('shdw-input', Input::class);
        Blade::component('shdw-textarea', TextArea::class);
        Blade::component('shdw-select', Select::class);
        Blade::component('shdw-search', Search::class);
        Blade::component('shdw-file', File::class);
        Blade::component('shdw-mega-menu', MegaMenu::class);
        Blade::component('shdw-carousel', Carousel::class);
        Blade::component('shdw-img', Image::class);
        Blade::component('shdw-card', Card::class);
        Blade::component('shdw-headline', Headline::class);
        Blade::component('shdw-checkbox', Checkbox::class);


    }
}
