<?php

namespace App\Providers;

use App\Forms\ImagesWithError;
use App\Forms\ImageWithError;
use SleepingOwl\Admin\Form\FormButtons;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use PackageManager;
use Meta;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\User::class => 'App\Http\Sections\Users',
        \Spatie\Permission\Models\Role::class => 'App\Http\Sections\Roles',
        \App\Models\Page::class => 'App\Http\Sections\Pages',
        \App\Models\Variable::class => 'App\Http\Sections\Variables',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {

        $this->app->bind(FormButtons::class, \App\Classes\FormButtons::class);

        app('sleeping_owl.form.element')->add('image2', ImageWithError::class);

        app('sleeping_owl.form.element')->add('images2', ImagesWithError::class);

        $this->registerMediaPackages();

        parent::boot($admin);

    }

    private function registerMediaPackages()
    {
        PackageManager::add('custom')
            ->js('admin', asset('back/js/admin.js'), 'jquery', true)
            ->css('admin', asset('back/css/admin.css'));

        Meta::loadPackage('custom');

    }
}
