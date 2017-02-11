<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Hj\Exception\FileIsEmptyException;

/**
 * Transform an csv file into array
 *
 * Class CsvMapper
 * @package Hj
 */
class CsvMapper
{
    /**
     * @var CsvFile
     */
    private $csvFile;

    /**
     * @param CsvFile $csvFile
     */
    public function __construct(CsvFile $csvFile)
    {
        $this->csvFile = $csvFile;
    }

    /**
     * Return all lines of the csv file
     * example :
     * array(
     *  array(cell-11, cell-12),
     *  array(cell-21, cell-22)
     * )
     *
     * @return array
     * @throws FileIsEmptyException
     */
    public function toArray()
    {
        if (true === $this->csvFile->fileIsEmpty()) {
            throw new FileIsEmptyException("The csv file is empty.");
        }

        return array_map('str_getcsv', file($this->csvFile->getFilename()));
    }

    /**
     * @return \Hj\CsvFile
     */
    public function getCsvFile()
    {
        return $this->csvFile;
    }

    /**
     * @return \stdClass
     */
    public function toObject()
    {
        throw new \RuntimeException(__CLASS__ . "::" . "toObject() is not implemented.");
    }
}