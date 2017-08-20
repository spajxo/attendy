<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\TimeEntry;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class TimeEntryRepository
 * @package AppBundle\Entity\Repository
 */
class TimeEntryRepository extends EntityRepository
{

    /**
     * @param DateTime $month
     * @return TimeEntry[]
     */
    public function findAllInMonth(DateTime $month)
    {
        $month = DateTimeImmutable::createFromMutable($month);
        $from = $month->modify('first day of this month');
        $to = $month->modify('last day of this month');

        return $this->findAllBetweenDates($from, $to);
    }

    /**
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @return TimeEntry[]
     */
    public function findAllBetweenDates(DateTimeInterface $from, DateTimeInterface $to)
    {
        $qb = $this->createQueryBuilder('te');
        $qb->where('te.date BETWEEN :from AND :to');
        $qb->setParameter('from', $from);
        $qb->setParameter('to', $to);

        return $qb->getQuery()->getResult();
    }

}