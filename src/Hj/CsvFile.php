<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Hj\Exception\FileFormatException;
use Hj\Exception\FileNotFoundException;

/**
 * I am a csv file
 *
 * Class CsvFile
 * @package Hj
 */
class CsvFile
{
    const CLASS_NAME = __CLASS__;
    const CSV_FILE_EXTENSION = 'csv';

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * @var string
     */
    private $enclosure;

    /**
     * @var string
     */
    private $escape;

    /**
     * @param string $filename
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct($filename, $delimiter = ",", $enclosure = '"', $escape = "\\")
    {
        $this->setFilename($filename);
        $this->validCsv();

        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * @return string
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getBaseName()
    {
        return basename($this->filename, '.' . self::CSV_FILE_EXTENSION);
    }

    /**
     * @return bool
     */
    public function fileIsEmpty()
    {
        return filesize($this->getFilename()) === 0;
    }

    /**
     * @throws FileFormatException
     */
    private function validCsv()
    {
        if (false === $this->isCsv()) {
            throw new FileFormatException('The file is not a csv file');
        }
    }

    /**
     * @return bool
     */
    private function isCsv()
    {
        return self::CSV_FILE_EXTENSION === pathinfo($this->filename, PATHINFO_EXTENSION);
    }

    /**
     * @param string $filename
     *
     * @throws Exception\FileNotFoundException
     */
    private function setFilename($filename)
    {
        if (false === is_file($filename)) {
            throw new FileNotFoundException("The file does not exist");
        }

        $this->filename = $filename;
    }
}