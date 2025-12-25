<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        Tenant::create(['name' => 'Default Tenant']);

        \App\Models\Tenant::firstOrCreate(
            ['id' => 1],
            ['name' => 'Default Tenant']
        );
    }
}
