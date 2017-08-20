<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 30.4.17
 * Time: 16:39
 */

namespace AppBundle\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class TimeCard
 */
class TimeCard
{

    /**
     * @var \DateTime
     */
    protected $month;

    /**
     * @var TimeEntry[]|ArrayCollection
     */
    protected $entries;

    /**
     * @var int
     */
    protected $workedMinutes = 0;

    /**
     * TimeCard constructor.
     * @param \DateTime $month
     * @param array     $entries
     */
    public function __construct(\DateTime $month, array $entries)
    {
        $this->entries = new ArrayCollection($entries);

        foreach ($this->entries as $entry) {
            $this->workedMinutes += $entry->getWorkedMinutes();
        }
    }

    /**
     * @return TimeEntry[]|ArrayCollection
     */
    public function getEntries(): ArrayCollection
    {
        return $this->entries;
    }

    /**
     * @param DateTimeInterface $date
     * @return TimeEntry
     */
    public function getEntryByDate(DateTimeInterface $date): TimeEntry
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('date', $date))->setFirstResult(1);

        return $this->entries->matching($criteria)->first();
    }

    /**
     * @return int
     */
    public function getWorkedMinutes(): int
    {
        return $this->workedMinutes;
    }


    /**
     * @return float
     */
    public function getWorkedHours(): float
    {
        return $this->workedMinutes / 60;
    }

}