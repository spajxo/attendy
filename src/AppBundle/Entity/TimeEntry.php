<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 30.4.17
 * Time: 16:42
 */

namespace AppBundle\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TimeEntry
 * @package AppBundle\Model
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TimeEntryRepository")
 * @ORM\Table("app_time_entry")
 * @UniqueEntity(fields={"date", "user"})
 */
class TimeEntry
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var UserInterface
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var DateTimeInterface
     * @Assert\DateTime()
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @var string
     * @Assert\Time()
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    protected $timeIn = '';

    /**
     * @var string
     * @Assert\Time()
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    protected $timeOut = '';

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $timeBreak = 60;

    /**
     * TimeEntry constructor.
     * @param UserInterface     $user
     * @param DateTimeInterface $date
     */
    public function __construct(UserInterface $user, DateTimeInterface $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getTimeIn(): string
    {
        return $this->timeIn;
    }

    /**
     * @param string $timeIn
     */
    public function setTimeIn(string $timeIn)
    {
        $this->timeIn = $timeIn;
    }

    /**
     * @return string
     */
    public function getTimeOut(): string
    {
        return $this->timeOut;
    }

    /**
     * @param string $timeOut
     */
    public function setTimeOut(string $timeOut)
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @return int
     */
    public function getTimeBreak(): int
    {
        return $this->timeBreak;
    }

    /**
     * @param int $timeBreak
     */
    public function setTimeBreak(int $timeBreak)
    {
        $this->timeBreak = $timeBreak;
    }

    /**
     * @return int number of minutes worked
     */
    public function getWorkedMinutes(): int
    {
        return $this->getTimeWorked()->getMinutes();
    }

    /**
     * @return float
     */
    public function getWorkedHours(): float
    {
        return $this->getTimeWorked()->getHours();
    }


    /**
     * @return TimeWorked
     */
    public function getTimeWorked()
    {
        return new TimeWorked($this->getDatetimeFrom(), $this->getDatetimeTo());
    }

    /**
     * @return DateTimeInterface
     */
    public function getDatetimeFrom(): DateTimeInterface
    {
        /** @var \DateTime $from */
        $from = clone $this->date;
        list($hours, $minutes) = explode(':', $this->timeIn);
        $from->setTime($hours, $minutes);

        return $from;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDatetimeTo(): DateTimeInterface
    {
        /** @var \DateTime $to */
        $to = clone $this->date;
        list($hours, $minutes) = explode(':', $this->timeOut);
        $to->setTime($hours, $minutes);

        return $to;
    }
}