<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Hj\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Count total line in a given file
 *
 * Class FileLineCounter
 * @package Hj
 */
class FileLineCounter
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @param FileManager $fileManager
     * @param Filesystem $filesystem
     */
    public function __construct(FileManager $fileManager, Filesystem $filesystem = null)
    {
        $this->fileManager = $fileManager;
        $this->fileSystem = $filesystem;

        if (null === $filesystem) {
            $this->fileSystem = new Filesystem();
        }
    }

    /**
     * @param string $filename
     *
     * @return int
     */
    public function countLine($filename)
    {
        $this->guardAgainstNotExistingFile($filename);

        $lines = 0;

        $this->fileManager->open($filename);

        while ($this->fileManager->getContent()) {
            $lines ++;
        }

        $this->fileManager->close();

        return $lines;
    }

    /**
     * @param string $filename
     * @throws \Hj\Exception\FileNotFoundException
     */
    private function guardAgainstNotExistingFile($filename)
    {
        if (false === $this->fileSystem->exists($filename)) {
            throw new FileNotFoundException("The file {$filename} does not exist");
        }
    }
}