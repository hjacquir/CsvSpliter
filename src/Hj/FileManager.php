<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

class FileManager
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * Open a file and return the resource
     *
     * @param string $filename
     * @param string $mode
     *
     * @return resource
     */
    public function open($filename, $mode = 'r')
    {
        $this->resource = fopen($filename, $mode);

        return $this->resource;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return fgets($this->resource);
    }

    public function close()
    {
        fclose($this->resource);
    }
}