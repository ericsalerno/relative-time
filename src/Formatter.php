<?php
/**
 * Build a relative time string from a timestamp
 *
 * @package SalernoLabs
 * @subpackage RelativeTime
 * @author Eric Salerno
 */
namespace SalernoLabs\RelativeTime;

class Formatter
{
    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var bool
     */
    private $showLabel = true;

    /**
     * Set start date
     *
     * @param \DateTime $startDate
     * @return $this
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Set show labels or not
     *
     * @param $showLabels
     * @return $this
     */
    public function setShowLabels($showLabels)
    {
        $this->showLabel = $showLabels;

        return $this;
    }

    /**
     * Get the relative time as a string
     *
     * @param \DateTime $time
     * @return string
     */
    public function getRelativeTime(\DateTime $time)
    {
        //Calculate the difference between the start and end dates
        if (!empty($this->startDate))
        {
            $startingTimeStamp = intval($this->startDate->format('U'));
        }
        else
        {
            $startingTimeStamp = time();
        }

        $endingTimeStamp = intval($time->format('U'));

        $difference = ($startingTimeStamp - $endingTimeStamp);

        //First figure out the correct label to use
        $label = '';
        $isPast = ($difference > 0);

        if ($this->showLabel)
        {
            $label = ($isPast ? ' ago' : ' from now');
        }

        //Use absolute value for figuring out the actual difference
        $difference = abs($difference);

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $year = $day * 365;

        $output = '';

        //Get the right timeslice for the difference (code we've seen countless other places)
        if ($difference < 10)
        {
            //It just happened, lets call it "just now"
            if ($isPast)
            {
                $output .= "just now";
            }
            else
            {
                $output .= "momentarily";
            }
        }
        else if ($difference < $minute)
        {
            //Its less than a minute but more than "just now" so lets give seconds.
            $output .= $difference . " seconds" . $label;
        }
        else if ($difference < ($minute * 2))
        {
            //Less than two minutes so lets say "about a minute"
            $output .= "about a minute" . $label;
        }
        else if ($difference < $hour)
        {
            //More than "about a minute" but less than an hour so lets say how many minutes
            $amount = round($difference / $minute);
            $output .= $amount . ' minute' . ($amount != 1 ? 's' : '') . $label;
        }
        else if ($difference < ($hour * 2))
        {
            //More than an hour but less than 2, lets say "about an hour"
            $output .= "about an hour" . $label;
        }
        else if ($difference < $day)
        {
            //More than 2 hours but less than a day, lets give hours
            $amount = round($difference / $hour);
            $output .= $amount . ' hour' . ($amount != 1 ? 's' : '') . $label;
        }
        else if ($difference < ($day * 2))
        {
            //More than a day but less than 2, lets use human readable "yesterday" or "tomorrow"'s
            if ($isPast)
            {
                $output .= "yesterday";
            }
            else
            {
                $output .= "tomorrow";
            }
        }
        else if ($difference < $year)
        {
            //More than 2 days but less than a year, lets give number of days
            $amount = round($difference / $day);
            $output .= $amount . ' day' . ($amount != 1 ? 's' : '') . $label;
        }
        else
        {
            //More than a year, lets just give years
            $amount = round($difference / $year);
            $output .= $amount . ' year' . ($amount != 1 ? 's' : '') . $label;
        }

        return $output;
    }

    /**
     * Get relative time as an HTML5 tag
     *
     * @param \DateTime $time
     * @return string
     */
    public function getRelativeTimeTag(\DateTime $time)
    {
        $timeString = $this->getRelativeTime($time);

        return '<time title="' . $time->format('F jS, Y - g:iA T') . '">' . $timeString . '</time>';
    }
}