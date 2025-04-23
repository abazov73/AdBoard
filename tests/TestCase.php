<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app = $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        Artisan::call('migrate');
        User::create(['name' => 'test', 'email' => 'test@example.com', 'password' => 'test']);
    }
}
