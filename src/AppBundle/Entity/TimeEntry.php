<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 29.5.16
 * Time: 19:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TimeEntry
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table("app_time_entry")
 * @UniqueEntity(fields={"date", "user"})
 * @ORM\HasLifecycleCallbacks()
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
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @var User
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     * @Assert\Time()
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    protected $timeIn;

    /**
     * @var string
     * @Assert\Time()
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    protected $timeOut;

    /**
     * Length of break in minutes
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $break = 0;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * @return string
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param string $timeIn
     */
    public function setTimeIn($timeIn)
    {
        $this->timeIn = $timeIn;
    }

    /**
     * @return string
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param string $timeOut
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @return int
     */
    public function getBreak()
    {
        return $this->break;
    }

    /**
     * @param int $break
     */
    public function setBreak($break)
    {
        $this->break = $break;
    }
}