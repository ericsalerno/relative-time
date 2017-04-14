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
     * @dataProvider dataProviderForRelativeTimeTest
     */
    public function testRelativeTime($timeModify, $expectedOutput)
    {
        $formatter = new \SalernoLabs\RelativeTime\Formatter();

        $this->assertEquals($expectedOutput, $formatter->getRelativeTime(new \DateTime($timeModify)));
    }

    /**
     * Data provider for the test
     *
     * @return array
     */
    public function dataProviderForRelativeTimeTest()
    {
        return [
            ['-5 seconds', 'just now'],
            ['+5 seconds', 'momentarily'],

            ['-1 minutes', 'about a minute ago'],
            ['+1 minutes', 'about a minute from now'],
            ['-2 minutes', '2 minutes ago'],
            ['+2 minutes', '2 minutes from now'],
            ['-20 minutes', '20 minutes ago'],

            ['-1 hour', 'about an hour ago'],
            ['+1 hour', 'about an hour from now'],
            ['-2 hours', '2 hours ago'],
            ['+2 hours', '2 hours from now'],

            ['-1 day', 'yesterday'],
            ['-2 days', '2 days ago'],
            ['+1 day', 'tomorrow'],
            ['+2 days', '2 days from now'],

            ['-1 year', '1 year ago'],
            ['-2 year', '2 years ago'],
            ['+1 year', '1 year from now'],
            ['+2 years', '2 years from now']
        ];
    }

    /**
     * Test relative time tag generation
     *
     * @param $timeModify
     * @param $expectedOutput
     * @covers \SalernoLabs\RelativeTime\Formatter::getRelativeTimeTag
     * @dataProvider dataProviderTimeTagTest
     */
    public function testRelativeTimeTag($timeModify, $expectedOutput)
    {
        $formatter = new \SalernoLabs\RelativeTime\Formatter();

        $this->assertRegExp($expectedOutput, $formatter->getRelativeTimeTag(new \DateTime($timeModify)));
    }

    /**
     * Test the generation of the time tag wtih this data
     *
     * @return array
     */
    public function dataProviderTimeTagTest()
    {
        return [
            ['-1 day', '#<time title=".*?">yesterday</time>#'],
            ['-2 day', '#<time title=".*?">2 days ago</time>#'],
            ['-1 year', '#<time title=".*?">1 year ago</time>#'],
            ['+5 seconds', '#<time title=".*?">momentarily</time>#'],
        ];
    }

    /**
     * Test no labels
     *
     * @param $timeModify
     * @param $expectedOutput
     * @covers \SalernoLabs\RelativeTime\Formatter::setShowLabels
     * @dataProvider dataProviderNoLabelTest
     */
    public function testNoLabels($timeModify, $expectedOutput)
    {
        $formatter = new \SalernoLabs\RelativeTime\Formatter();

        $formatter->setShowLabels(false);

        $this->assertRegExp($expectedOutput, $formatter->getRelativeTimeTag(new \DateTime($timeModify)));
    }

    /**
     * Data provider for no label test
     *
     * @return array
     */
    public function dataProviderNoLabelTest()
    {
        return [
            ['-1 day', '#<time title=".*?">yesterday</time>#'],
            ['+1 day', '#<time title=".*?">tomorrow</time>#'],
            ['-2 day', '#<time title=".*?">2 days</time>#'],
            ['-1 year', '#<time title=".*?">1 year</time>#'],
            ['+5 seconds', '#<time title=".*?">momentarily</time>#'],
            ['-2 year', '#<time title=".*?">2 years</time>#'],
        ];
    }

}