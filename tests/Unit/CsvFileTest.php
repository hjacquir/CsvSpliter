<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace tests\Unit;

use Hj\CsvFile;

/**
 * Class CsvFileTest
 * @package tests\Unit
 */
class CsvFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsvFile
     */
    private $csvFile;

    public function setUp()
    {
        $this->csvFile = new CsvFile(__DIR__ . '/foo.csv');
    }

    public function testCsvFileShouldHaveDelimiterEnclosureEscapeDefaultValues()
    {
        $this->assertSame(',', $this->csvFile->getDelimiter(), 'The default value delimiter is not as expected');
        $this->assertSame('"', $this->csvFile->getEnclosure(), 'The default value enclosure is not as expected');
        $this->assertSame('\\', $this->csvFile->getEscape(), 'The default value escape is not as expected');
    }

    public function testShouldGetTheFilename()
    {
        $this->assertSame(__DIR__ . '/foo.csv', $this->csvFile->getFilename(), 'The filename is not as expected');
    }

    public function testShouldGetTheBasename()
    {
        $this->assertSame('foo', $this->csvFile->getBaseName(), 'The base name is not as expected');
    }

    /**
     * @expectedException \Hj\Exception\FileNotFoundException
     * @expectedExceptionMessage The file does not exist
     */
    public function testShouldThrowAnExceptionWhenTheFileDoesNotExist()
    {
        new CsvFile('bla.csv');
    }

    public function testFileIsEmptyShouldReturnFalseWhenFileIsNotEmpty()
    {
        $this->assertFalse($this->csvFile->fileIsEmpty());
    }

    public function testFileIsEmptyShouldReturnTrueWhenFileIsEmpty()
    {
        $csv = new CsvFile(__DIR__ . '/emptyFile.csv');
        $this->assertTrue($csv->fileIsEmpty());
    }

    /**
     * @expectedException \Hj\Exception\FileFormatException
     * @expectedExceptionMessage The file is not a csv file
     */
    public function testShouldThrowAnExceptionWhenTheFileIsNotACsv()
    {
        new CsvFile(__DIR__ . '/bla.txt');
    }
}