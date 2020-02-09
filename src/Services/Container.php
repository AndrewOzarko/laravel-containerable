<?php

namespace Ozarko\Containerable\Services;

use function Ozarko\Containerable\Helpers\{dir_is_empty};

class Container
{
    /**
     * @var
     */
    protected $name;

    public function __construct()
    {

    }

    /**
     * @param string $path
     * @return bool
     */
    public function dirIsEmpty(string $path): bool
    {
        if (!is_dir($path)) return false;
        foreach (scandir($path) as $file)
        {
            if (!in_array($file, array('.','..','.svn','.git'))) return false;
        }
        return true;
    }
    /**
     * @param string $name
     * @return Container
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
