<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_user")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var UploadedFile
     * @Assert\File(maxSize="2048k")
     * @Assert\Image(mimeTypesMessage="Please upload a valid image.")
     */
    protected $avatarFile;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $avatarPath;
    private $avatarTemp;

    /**
     * @return string
     */
    public function getAvatarPath()
    {
        return $this->avatarPath;
    }

    /**
     * @param string $avatarPath
     */
    public function setAvatarPath($avatarPath)
    {
        $this->avatarPath = $avatarPath;
    }

    /**
     * @return null|string
     */
    public function getAvatarWebPath()
    {
        return $this->avatarPath ? $this->getUploadDir().'/'.$this->avatarPath : null;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadAvatar()
    {
        if ($this->getAvatarFile() !== null) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->avatarPath = "$filename.".$this->getAvatarFile()->guessExtension();
        }
    }

    /**
     * @return UploadedFile
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * @param UploadedFile $avatarFile
     */
    public function setAvatarFile(UploadedFile $avatarFile = null)
    {
        $this->avatarFile = $avatarFile;

        // check if we have old image
        if (isset($this->avatarPath)) {
            // store old image path to temp
            $this->avatarTemp = $this->avatarPath;
            $this->avatarPath = null;
        } else {
            $this->avatarPath = 'initial';
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadAvatar()
    {
        if (!$this->getAvatarFile()) {
            return;
        }

        $this->getAvatarFile()->move($this->getUploadRootDir(), $this->avatarPath);

        if (isset($this->avatarTemp) && file_exists($this->getUploadRootDir().'/'.$this->avatarTemp)) {
            unlink($this->getUploadRootDir().'/'.$this->avatarTemp);
            $this->avatarTemp = null;
        }
        $this->avatarFile = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeAvatar()
    {
        $file = $this->getAvatarAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * @return null|string
     */
    public function getAvatarAbsolutePath()
    {
        return $this->avatarPath ? $this->getUploadRootDir().'/'.$this->avatarPath : null;
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads/avatars';
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

}