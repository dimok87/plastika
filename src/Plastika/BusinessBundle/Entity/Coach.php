<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="coach")
 */
class Coach
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
     * @ORM\OneToMany(targetEntity="CoachImage", mappedBy="coach", cascade={"all"})
     */
    protected $images;
    
    /**
     * @ORM\OneToMany(targetEntity="CoachVideo", mappedBy="coach", cascade={"all"})
     */
    protected $video;
    
    /**
     * @ORM\OneToMany(targetEntity="CoachDocument", mappedBy="coach", cascade={"all"})
     */
    protected $documents;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $image;
    
    /**
     * @ORM\ManyToMany(targetEntity="Style", mappedBy="coaches", cascade={"persist"})
     */
    private $styles;
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->video = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->styles = new ArrayCollection();
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/photos';
    }
    
    /**
     * Sets image.
     *
     * @param UploadedFile $image
     */
    public function setImage(UploadedFile $image = null)
    {
        $this->image = $image;
    }

    /**
     * Get image.
     *
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }
    
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getImage()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getImage()->move(
            $this->getUploadRootDir(),
            $this->getImage()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getImage()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->image = null;
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
     * @return Coach
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
     * @return Coach
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
     * @return Coach
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
     * Set path
     *
     * @param string $path
     * @return Coach
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add images
     *
     * @param \Plastika\BusinessBundle\Entity\CoachImage $images
     * @return Coach
     */
    public function addImage(\Plastika\BusinessBundle\Entity\CoachImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Plastika\BusinessBundle\Entity\CoachImage $images
     */
    public function removeImage(\Plastika\BusinessBundle\Entity\CoachImage $images)
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
     * @param \Plastika\BusinessBundle\Entity\CoachVideo $video
     * @return Coach
     */
    public function addVideo(\Plastika\BusinessBundle\Entity\CoachVideo $video)
    {
        $this->video[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Plastika\BusinessBundle\Entity\CoachVideo $video
     */
    public function removeVideo(\Plastika\BusinessBundle\Entity\CoachVideo $video)
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
     * Add documents
     *
     * @param \Plastika\BusinessBundle\Entity\CoachDocument $documents
     * @return Coach
     */
    public function addDocument(\Plastika\BusinessBundle\Entity\CoachDocument $documents)
    {
        $this->documents[] = $documents;

        return $this;
    }

    /**
     * Remove documents
     *
     * @param \Plastika\BusinessBundle\Entity\CoachDocument $documents
     */
    public function removeDocument(\Plastika\BusinessBundle\Entity\CoachDocument $documents)
    {
        $this->documents->removeElement($documents);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add styles
     *
     * @param \Plastika\BusinessBundle\Entity\Style $styles
     * @return Coach
     */
    public function addStyle(\Plastika\BusinessBundle\Entity\Style $styles)
    {
        $this->styles[] = $styles;

        return $this;
    }

    /**
     * Remove styles
     *
     * @param \Plastika\BusinessBundle\Entity\Style $styles
     */
    public function removeStyle(\Plastika\BusinessBundle\Entity\Style $styles)
    {
        $this->styles->removeElement($styles);
    }

    /**
     * Get styles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStyles()
    {
        return $this->styles;
    }
}
