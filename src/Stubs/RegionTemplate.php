<?php

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use SlovenianGooner\NovaPager\Template;

class :className extends Template
{
    public static $type = ':type';
    public static $name = ':name';

    public function fields(Request $request): array
    {
        return [];
    }
}
