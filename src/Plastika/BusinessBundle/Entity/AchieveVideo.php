<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="achieve_video")
 * @ORM\Entity()
 */
class AchieveVideo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Achieve", inversedBy="video")
     * @ORM\JoinColumn(name="achieve_id", referencedColumnName="id")
     */
    private $achieve;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $url;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return AchieveVideo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * Set achieve
     *
     * @param \Plastika\BusinessBundle\Entity\Achieve $achieve
     * @return AchieveVideo
     */
    public function setAchieve(\Plastika\BusinessBundle\Entity\Achieve $achieve = null)
    {
        $this->achieve = $achieve;

        return $this;
    }

    /**
     * Get achieve
     *
     * @return \Plastika\BusinessBundle\Entity\Achieve 
     */
    public function getAchieve()
    {
        return $this->achieve;
    }
}
