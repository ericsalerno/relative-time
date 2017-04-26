<?php
/**
 * Build a relative clock time stamp
 *
 * @package SalernoLabs
 * @subpackage RelativeTime
 * @author Eric Salerno
 */
namespace SalernoLabs\RelativeTime;

class Clock
{
    /**
     * @var \DateTime|null
     */
    private $time = null;

    private $numberText = [
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve'
    ];

    /**
     * @param \DateTime $dateTime
     * @return $this
     */
    public function setTime(\DateTime $dateTime)
    {
        $this->time = $dateTime;

        return $this;
    }

    public function getTime()
    {
        $timestamp = $this->time;
        if (empty($timestamp))
        {
            $timestamp = new \DateTime();
        }

        $hour = intval($timestamp->format('g'));
        $minutes = intval($timestamp->format('i'));

        $hourText = $this->numberText[$hour];
        $nextHour = ($hour + 1);
        if ($nextHour == 13) $nextHour = 1;
        $nextHourText = $this->numberText[$nextHour];

        $response = '';

        if ($minutes >= 0 && $minutes <= 4)
        {
            $response = $hourText;
        }
        else if ($minutes >= 5 && $minutes <= 9)
        {
            $response = 'almost ten after ' . $hourText;
        }
        else if ($minutes >= 10 && $minutes <= 14)
        {
            $response = 'ten after ' . $hourText;
        }
        else if ($minutes >= 15 && $minutes <= 19)
        {
            $response = 'quarter after ' . $hourText;
        }
        else if ($minutes >= 20 && $minutes <= 29)
        {
            $response = 'almost half past ' . $hourText;
        }
        else if ($minutes >= 30 && $minutes <= 38)
        {
            $response = 'half past ' . $hourText;
        }
        else if ($minutes >= 39 && $minutes <= 44)
        {
            $response = 'almost a quarter to ' . $nextHourText;
        }
        else if ($minutes >= 45 && $minutes <= 54)
        {
            $response = 'a quarter to ' . $nextHourText;
        }
        else if ($minutes >= 54 && $minutes <= 59)
        {
            $response = 'almost ' . $nextHourText;
        }

        $response .= ' o\'clock';
        return $response;
    }
}