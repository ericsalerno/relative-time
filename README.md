# relative-time
Library for building relative time strings in PHP.

## Usage

### Installation

First include this project with composer

    composer require ericsalerno/relative-time

### Formatting Time

Then run the formatter on a DateTime object.

    $formatter = new \SalernoLabs\RelativeTime\Formatter();
    $relativeTime = $formatter->getRelativeTime(new \DateTime('-47 minutes'));
    echo $relativeTime;

This would output '47 minutes ago'. The formatter will also go forward as well so if you put in '+47 minutes' it will say "47 mintues from now".

### Examples of Time Reformatting

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

### HTML5 Tags

You can easily wrap the output in an html5 time tag by using the getRelativeTimeTag function.

    $formatter = new \SalernoLabs\RelativeTime\Formatter();
    $relativeTime = $formatter->getRelativeTimeTag(new \DateTime('-47 minutes'));
    echo $relativeTime;

This would output:

    <time title="April 14th, 2017 - 4:14PM EDT">47 minutes ago</time>