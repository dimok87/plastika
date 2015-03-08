<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="style")
 */
class Style
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
     * @var string
     *
     * @ORM\Column(type="float")
     */
    private $price;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @ORM\OneToMany(targetEntity="StyleImage", mappedBy="style", cascade={"all"})
     */
    protected $images;
    
    /**
     * @ORM\ManyToMany(targetEntity="Coach", inversedBy="styles", cascade={"persist"})
     *
     */
    private $coaches;
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->coaches = new ArrayCollection();
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
     * @return Style
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
     * @return Style
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
     * @return Style
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
     * @param \Plastika\BusinessBundle\Entity\StyleImage $images
     * @return Style
     */
    public function addImage(\Plastika\BusinessBundle\Entity\StyleImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Plastika\BusinessBundle\Entity\StyleImage $images
     */
    public function removeImage(\Plastika\BusinessBundle\Entity\StyleImage $images)
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
     * Add coaches
     *
     * @param \Plastika\BusinessBundle\Entity\Coach $coaches
     * @return Style
     */
    public function addCoach(\Plastika\BusinessBundle\Entity\Coach $coaches)
    {
        $this->coaches[] = $coaches;

        return $this;
    }

    /**
     * Remove coaches
     *
     * @param \Plastika\BusinessBundle\Entity\Coach $coaches
     */
    public function removeCoach(\Plastika\BusinessBundle\Entity\Coach $coaches)
    {
        $this->coaches->removeElement($coaches);
    }

    /**
     * Get coaches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Style
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
