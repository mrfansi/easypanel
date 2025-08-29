<?php

namespace Mrfansi\Easypanel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mrfansi\Easypanel\Easypanel
 */
class Easypanel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mrfansi\Easypanel\Easypanel::class;
    }
}
