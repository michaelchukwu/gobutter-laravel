<?php

namespace App\Providers;

use App\MailHandler;
use BeyondCode\Mailbox\Facades\Mailbox;
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
        Mailbox::to('contact@demo.ceeless.com', MailHandler::class);
        // Mailbox::catchAll(MailHandler::class);
    }
}
