<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 29.5.16
 * Time: 19:35
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MonthlyTimeCard
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table("app_time_card")
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
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    protected $month;

    /**
     * MonthlyTimeCard constructor.
     */
    public function __construct()
    {
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
     * @return \DateTime
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param \DateTime $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return TimeEntry[]
     */
    public function getTimeEntries()
    {
        return $this->timeEntries;
    }

    /**
     * @param TimeEntry[] $timeEntries
     */
    public function setTimeEntries($timeEntries)
    {
        $this->timeEntries = $timeEntries;
    }

}