<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 5.2.17
 * Time: 18:28
 */

namespace AppBundle\Model;

use AppBundle\Entity\User;

/**
 * Class TimeEntry
 * @package AppBundle\Model
 */
interface TimeEntryInterface
{
    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @param \DateTime $date
     */
    public function setDate($date);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param User $user
     */
    public function setUser($user);

    /**
     * @return string
     */
    public function getTimeIn();

    /**
     * @param string $timeIn
     */
    public function setTimeIn($timeIn);

    /**
     * @return string
     */
    public function getTimeOut();

    /**
     * @param string $timeOut
     */
    public function setTimeOut($timeOut);

    /**
     * @return int
     */
    public function getBreak();

    /**
     * @param int $break
     */
    public function setBreak($break);
}