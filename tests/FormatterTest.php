<?php
/**
 * Relative Time Test
 *
 * @package SalernoLabs
 * @subpackage Tests
 * @author Eric Salerno
 */
namespace SalernoLabs\Tests\RelativeTime;

class FormatterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test relative time generation
     * @covers \SalernoLabs\RelativeTime\Formatter::getRelativeTime
     */
    public function testRelativeTime()
    {
        $formatter = new \SalernoLabs\RelativeTime\Formatter();

        $this->assertEquals('1 day ago', $formatter->getRelativeTime(new \DateTime('-1 day')));
        $this->assertEquals('2 days ago', $formatter->getRelativeTime(new \DateTime('-2 days')));
        $this->assertEquals('1 year ago', $formatter->getRelativeTime(new \DateTime('-1 year')));
        $this->assertEquals('1 day from now', $formatter->getRelativeTime(new \DateTime('+1 day')));
        $this->assertEquals('20 minutes ago', $formatter->getRelativeTime(new \DateTime('-20 minutes')));
    }
}