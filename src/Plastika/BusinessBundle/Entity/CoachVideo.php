<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="coach_video")
 * @ORM\Entity()
 */
class CoachVideo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Coach", inversedBy="video")
     * @ORM\JoinColumn(name="coach_id", referencedColumnName="id")
     */
    private $coach;
    
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
     * @return CoachVideo
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
     * Set coach
     *
     * @param \Plastika\BusinessBundle\Entity\Coach $coach
     * @return CoachVideo
     */
    public function setCoach(\Plastika\BusinessBundle\Entity\Coach $coach = null)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach
     *
     * @return \Plastika\BusinessBundle\Entity\Coach 
     */
    public function getCoach()
    {
        return $this->coach;
    }
}
