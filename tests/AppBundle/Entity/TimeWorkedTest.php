<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\TimeWorked;
use PHPUnit\Framework\TestCase;

class TimeWorkedTest extends TestCase
{
    public function provideHours()
    {
        return [
            ['2017-01-01 10:00:00', '2017-01-04 9:00:00', 71],
            ['2017-01-01 10:00:00', '2017-01-01 13:22:04', 3],
            ['2017-01-01 8:00:00', '2017-01-01 16:00:00', 8],
        ];
    }

    /**
     * @dataProvider provideHours
     * @param $from
     * @param $to
     * @param $hours
     */
    public function testGetHours($from, $to, $hours)
    {
        $from = new \DateTime($from);
        $to = new \DateTime($to);
        $timeWorked = new TimeWorked($from, $to);

        self::assertEquals($hours, $timeWorked->getHours());
    }
}
