<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // ESTO FUERZA LA LLAVE ANTES DE QUE EMPIECE CUALQUIER TEST
        Config::set('app.key', 'base64:OTY0NjU0MzIxMDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=');
    }
}