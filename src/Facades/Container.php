<?php


namespace Ozarko\Containerable\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static dirIsEmpty(string $path): bool
 * @method static writeFileWithContent(string $string, string $controllerContent, array $array)
 * @method static makeStub(array $array, array $array1, string $string)
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
