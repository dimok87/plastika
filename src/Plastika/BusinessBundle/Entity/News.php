<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
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
     * @ORM\OneToMany(targetEntity="NewsImage", mappedBy="news", cascade={"all"})
     */
    protected $images;
    
    /**
     * @ORM\OneToMany(targetEntity="NewsVideo", mappedBy="news", cascade={"all"})
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @param \Plastika\BusinessBundle\Entity\NewsImage $images
     * @return News
     */
    public function addImage(\Plastika\BusinessBundle\Entity\NewsImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Plastika\BusinessBundle\Entity\NewsImage $images
     */
    public function removeImage(\Plastika\BusinessBundle\Entity\NewsImage $images)
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
     * @param \Plastika\BusinessBundle\Entity\NewsVideo $video
     * @return News
     */
    public function addVideo(\Plastika\BusinessBundle\Entity\NewsVideo $video)
    {
        $this->video[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Plastika\BusinessBundle\Entity\NewsVideo $video
     */
    public function removeVideo(\Plastika\BusinessBundle\Entity\NewsVideo $video)
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
}
