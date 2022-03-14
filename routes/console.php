<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment("Hello World");
})->purpose('Display an inspiring quote');

Artisan::command('who-are-you', function () {
    $this->comment("Hello, my name is Amr Ragab I'm a Full stack developer");
})->purpose('Display an inspiring quote');

Artisan::command('where-are-you-from', function () {
    $this->comment("Cairo, Egypt");
})->purpose('Display an inspiring quote');
