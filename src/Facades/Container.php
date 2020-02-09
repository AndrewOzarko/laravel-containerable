<?php


namespace Ozarko\Containerable\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static dirIsEmpty(string $path): bool
 */
class Container extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-container';
    }

}
