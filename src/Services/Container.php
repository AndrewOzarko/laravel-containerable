<?php

namespace Ozarko\Containerable\Services;

use Illuminate\Contracts\Filesystem\FileExistsException;

class Container
{
    /**
     * @var
     */
    protected $name;

    /**
     * @param string $path
     * @return bool
     */
    public function dirIsEmpty(string $path): bool
    {
        if (! is_dir($path)) return false;

        foreach (scandir($path) as $file)
        {
            if (! in_array($file, array('.','..','.svn','.git'))) return false;
        }

        return true;
    }

    /**
     * @param string $filename
     * @return false|string
     */
    public function getStub(string $filename)
    {
        return file_get_contents(__DIR__."/../resources/stubs/{$filename}.stub");
    }

    /**
     * @param array $find
     * @param array $replace
     * @param string $stubName
     * @return string|string[]
     */
    public function makeStub(array $find, array $replace, string $stubName)
    {
        return str_replace($find, $replace, $this->getStub($stubName));
    }

    /**
     * @param string $filename
     * @param string $content
     * @param array $data
     * @return string|null
     * @throws FileExistsException
     */
    public function writeFileWithContent(string $filename, string $content, array $data)
    {
        /** @var string $containerName */
        $containerName = $data['container_name'];

        /** @var string $path */
        $path = $data['path'];

        /** @var string $pathToDir */
        $pathToDir = config('containers.paths.containers'). '/' .$containerName. '/' . $path;

        /** @var string $pathToFile */
        $pathToFile = $pathToDir. '/' . $filename;

        if (!file_exists($pathToDir))
            mkdir($pathToDir, 0666, true);

        if (file_exists($pathToFile))
            throw new FileExistsException('This file is exists.');

        return file_put_contents($pathToFile, $content) ? $pathToFile : null;
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
