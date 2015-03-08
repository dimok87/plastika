<?php

namespace Plastika\BusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="news_video")
 * @ORM\Entity()
 */
class NewsVideo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="News", inversedBy="video")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $news;
    
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
     * @return NewsVideo
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
     * Set news
     *
     * @param \Plastika\BusinessBundle\Entity\News $news
     * @return NewsVideo
     */
    public function setNews(\Plastika\BusinessBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Plastika\BusinessBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }
}
