<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace tests\Unit;

use Hj\CsvFile;
use Hj\CsvMapper;

class CsvMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsvMapper
     */
    private $csvMapper;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $csvFile;

    public function setUp()
    {
        $this->csvFile = $this->hjGetMockCsvFile();

        $this->csvMapper = new CsvMapper($this->csvFile);
    }

    /**
     * @expectedException \Hj\Exception\FileIsEmptyException
     * @expectedExceptionMessage The csv file is empty
     */
    public function testMethodToArrayShouldThrowAnExceptionWhenFileIsEmpty()
    {
        $this->csvFile
            ->expects($this->once())
            ->method('fileIsEmpty')
            ->will($this->returnValue(true));

        $this->csvMapper->toArray();
    }

    public function testMethodToArrayShouldReturnAnArrayOfValueWhenFileIsNotEmpty()
    {
        $expected = array(
            array(
                '1',
                'foo',
                'bar\'foo',
            ),
            array(
                '2',
                'bar',
            ),
        );

        $this->csvFile
            ->expects($this->once())
            ->method('fileIsEmpty')
            ->will($this->returnValue(false));
        $this->csvFile
            ->expects($this->once())
            ->method('getFileName')
            ->will($this->returnValue(__DIR__ . '/foo.csv'));

        $array = $this->csvMapper->toArray();

        $this->assertSame($expected, $array);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Hj\CsvMapper::toObject() is not implemented.
     */
    public function testToObjectShouldReturnARuntimeException()
    {
        $this->csvMapper->toObject();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function hjGetMockCsvFile()
    {
        return $this->getMockBuilder(CsvFile::CLASS_NAME)->disableOriginalConstructor()->getMock();
    }
}