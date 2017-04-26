<?php
/**
 * Clock Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\RelativeTime;

class ClockTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test relative time generation
     * @covers \SalernoLabs\RelativeTime\Clock::getTime
     * @covers \SalernoLabs\RelativeTime\Clock::setTime
     * @dataProvider dataProviderForClockTest
     */
    public function testClockTime($time, $expectedOutput)
    {
        $clock = new \SalernoLabs\RelativeTime\Clock();

        $clock->setTime(new \DateTime($time));

        $this->assertEquals($expectedOutput, $clock->getTime());
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function dataProviderForClockTest()
    {
        return [
            ['1:00', 'one o\'clock'],
            ['5:03', 'five o\'clock'],
            ['2:07', 'almost ten after two o\'clock'],
            ['3:10', 'ten after three o\'clock'],
            ['4:15', 'quarter after four o\'clock'],
            ['6:22', 'almost half past six o\'clock'],
            ['7:32', 'half past seven o\'clock'],
            ['8:44', 'almost a quarter to nine o\'clock'],
            ['9:45', 'a quarter to ten o\'clock'],
            ['11:55', 'almost twelve o\'clock'],
            ['12:00', 'twelve o\'clock'],
            ['12:59', 'almost one o\'clock'],
            ['12:45', 'a quarter to one o\'clock'],
            ['12:43', 'almost a quarter to one o\'clock']
        ];
    }
}