<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="achieve")
 */
class Achieve
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Поле не может быть пустым")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="full_text", type="text")
     * @Assert\NotBlank(message="Поле не может быть пустым")
     */
    private $fullText;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Поле не может быть пустым")
     */
    private $achieved;
    
    /**
     * @ORM\OneToMany(targetEntity="AchieveImage", mappedBy="achieve", cascade={"all"})
     */
    protected $images;
    
    /**
     * @ORM\OneToMany(targetEntity="AchieveVideo", mappedBy="achieve", cascade={"all"})
     */
    protected $video;
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->video = new ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Achieve
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set fullText
     *
     * @param string $fullText
     * @return Achieve
     */
    public function setFullText($fullText)
    {
        $this->fullText = $fullText;

        return $this;
    }

    /**
     * Get fullText
     *
     * @return string 
     */
    public function getFullText()
    {
        return $this->fullText;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Achieve
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add images
     *
     * @param \Plastika\BusinessBundle\Entity\AchieveImage $images
     * @return Achieve
     */
    public function addImage(\Plastika\BusinessBundle\Entity\AchieveImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Plastika\BusinessBundle\Entity\AchieveImage $images
     */
    public function removeImage(\Plastika\BusinessBundle\Entity\AchieveImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add video
     *
     * @param \Plastika\BusinessBundle\Entity\AchieveVideo $video
     * @return Achieve
     */
    public function addVideo(\Plastika\BusinessBundle\Entity\AchieveVideo $video)
    {
        $this->video[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Plastika\BusinessBundle\Entity\AchieveVideo $video
     */
    public function removeVideo(\Plastika\BusinessBundle\Entity\AchieveVideo $video)
    {
        $this->video->removeElement($video);
    }

    /**
     * Get video
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set achieved
     *
     * @param string $achieved
     * @return Achieve
     */
    public function setAchieved($achieved)
    {
        $this->achieved = $achieved;

        return $this;
    }

    /**
     * Get achieved
     *
     * @return string 
     */
    public function getAchieved()
    {
        return $this->achieved;
    }
}
