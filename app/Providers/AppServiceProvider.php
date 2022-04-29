<?php

namespace App\Providers;

use App\Models\Email;
use App\Models\Phone;
use App\Models\Sms;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
        Relation::enforceMorphMap([
            'email' => Email::class,
            'phone' => Phone::class,
            'sms' => Sms::class,
        ]);
    }
}
