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

    public function provideDataForTestGetMinutes() {
        return [
            ['2017-01-01 06:30:00', '2017-01-01 16:30:00', 60, 9 * 60],
            ['2017-01-01 06:00:00', '2017-01-01 17:00:00', 30, 11 * 60 - 30]
        ];
    }

    /**
     * @dataProvider provideDataForTestGetMinutes
     * @param $from
     * @param $to
     * @param $break
     * @param $minutes
     */
    public function testGetMinutes($from, $to, $break, $minutes) {
        $form = new \DateTime($from);
        $to = new \DateTime($to);
        $timeWorked = new TimeWorked($form, $to, $break);

        $this->assertEquals($minutes, $timeWorked->getMinutes());
    }
}
