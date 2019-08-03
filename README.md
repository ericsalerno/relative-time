# salernolabs/relative-time

[![Latest Stable Version](https://poser.pugx.org/salernolabs/relative-time/v/stable)](https://packagist.org/packages/salernolabs/relative-time)
[![License](https://poser.pugx.org/salernolabs/relative-time/license)](https://packagist.org/packages/salernolabs/relative-time)
[![Build Status](https://travis-ci.com/salernolabs/relative-time.svg?branch=master)](https://travis-ci.org/salernolabs/relative-time)

Library for building relative time strings in PHP.

## Usage

### Installation

First include this project with composer

    composer require salernolabs/relative-time

### Formatting Time

Then run the formatter on a DateTime object.

    $formatter = new \SalernoLabs\RelativeTime\Formatter();
    $relativeTime = $formatter->getRelativeTime(new \DateTime('-47 minutes'));
    echo $relativeTime;

This would output '47 minutes ago'. The formatter will also go forward as well so if you put in '+47 minutes' it will say "47 mintues from now".

#### Examples of Time Reformatting

This library will also give short-hand conversational outputs for some values. For example:

Time Modification  | Output
------------------ | ------------------
-5 minutes         | just now
+5 minutes         | momentarily
-1 minute          | about a minute ago
+1 minute          | about a minute from now
-1 hour            | about an hour ago
+1 hour            | about an hour from now
-1 day             | yesterday
+1 day             | tomorrow

 And actual numbers for other times, for example:

Time Modification | Output
----------------- | -----------------
-45 seconds       | 45 seconds ago
-45 minutes       | 45 minutes ago
-7 hours          | 7 hours ago
-3 years          | 3 years ago

#### HTML5 Tags

You can easily wrap the output in an html5 time tag by using the getRelativeTimeTag function.

    $formatter = new \SalernoLabs\RelativeTime\Formatter();
    $relativeTime = $formatter->getRelativeTimeTag(new \DateTime('-47 minutes'));
    echo $relativeTime;

This would output:

    <time title="April 14th, 2017 - 4:14PM EDT">47 minutes ago</time>

### Relative Time Clock

The relative time clock can give you a textual representation of a time of day.

    $clock = new \SalernoLabs\RelativeTime\Clock();

    $time = $clock
        ->setTime(new \DateTime('7:47'))
        ->getTime();

    echo $time; // a quarter to eight o'clock

#### Examples of Relative Clock Output

Input Time | Output
---------- | ----------
1:00       | one o'clock
5:03       | five o'clock,
2:07       | almost ten after two o'clock,
3:10       | ten after three o'clock
4:15       | quarter after four o'clock
6:22       | almost half past six o'clock
7:32       | half past seven o'clock
8:44       | almost a quarter to nine o'clock
9:45       | a quarter to ten o'clock
11:55      | almost twelve o'clock
12:00      | twelve o'clock,
12:59      | almost one o'clock
12:45      | a quarter to one o'clock
12:43      | almost a quarter to one o'clock