<?php

namespace AppBundle\Entity;

use DateTimeInterface;

/**
 * Class WorkedInterval
 * @package AppBundle\Entity
 */
class TimeWorked
{

    /**
     * @var DateTimeInterface
     */
    protected $from;

    /**
     * @var DateTimeInterface
     */
    protected $to;

    /**
     * @var int
     */
    protected $break;

    /**
     * @var int
     */
    protected $minutes;

    /**
     * TimeWorked constructor.
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param int               $break
     */
    public function __construct(DateTimeInterface $from, DateTimeInterface $to, int $break = 0)
    {
        $this->from = $from;
        $this->to = $to;
        $this->break = $break;

        $diff = $from->diff($to);
        $this->minutes = ($diff->days * 24 * 60 + $diff->h * 60 + $diff->i) - $this->break;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @return float
     */
    public function getHours(): float
    {
        return $this->minutes / 60;
    }


}