<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 29.5.16
 * Time: 19:35
 */

namespace AppBundle\Entity;

use AppBundle\Model\TimeEntryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MonthlyTimeCard
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table("app_time_card")
 * @UniqueEntity(fields={"user", "year", "month"})
 */
class TimeCard
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @Assert\NotBlank()
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Range(min="1970", max="2100")
     * @ORM\Column(type="smallint")
     */
    protected $year;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Range(min="1", max="12")
     * @ORM\Column(type="smallint")
     */
    protected $month;

    /**
     * @var ArrayCollection|TimeEntryInterface[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TimeEntry", mappedBy="timeCard")
     */
    protected $timeEntries;

    /**
     * MonthlyTimeCard constructor.
     * @param User $user
     * @param int  $year
     * @param int  $month
     */
    public function __construct(User $user, int $year, int $month)
    {
        $this->user = $user;
        $this->year = $year;
        $this->month = $month;
        $this->timeEntries = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return TimeEntryInterface[]
     */
    public function getTimeEntries()
    {
        return clone $this->timeEntries;
    }

    /**
     * @param TimeEntryInterface $timeEntry
     */
    public function addTimeEntry(TimeEntryInterface $timeEntry)
    {
        $this->timeEntries->add($timeEntry);
    }

}