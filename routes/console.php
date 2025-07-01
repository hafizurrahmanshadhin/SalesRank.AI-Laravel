<?php

use App\Console\Commands\MakeInterface;
use App\Console\Commands\MakeService;
use Illuminate\Support\Facades\Artisan;

// registering make service class command
Artisan::command('make:service {name}', function ($name) {
    $this->call(MakeService::class, ['name' => $name]);
});

// registering make interface class command
Artisan::command('make:interface {name}', function ($name) {
    $this->call(MakeInterface::class, ['name' => $name]);
});
