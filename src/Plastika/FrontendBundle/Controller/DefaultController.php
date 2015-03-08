<?php

namespace Plastika\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
    */
    public function indexAction()
    {
        return array('page' => 'index');
    }
    
    /**
     * @Route("/style/", name="style")
     * @Template()
    */
    public function styleAction()
    {
        return array('page' => 'style');
    }
    
    /**
     * @Route("/coaches/", name="coaches")
     * @Template()
    */
    public function coachesAction()
    {
        return array('page' => 'coaches');
    }
    
    /**
     * @Route("/coach/", name="coach")
     * @Template()
    */
    public function coachAction()
    {
        return array('page' => 'coaches');
    }
    
    /**
     * @Route("/timetable/", name="timetable")
     * @Template()
    */
    public function timetableAction()
    {
        return array('page' => 'timetable');
    }
    
    /**
     * @Route("/price/", name="price")
     * @Template()
    */
    public function priceAction()
    {
        return array('page' => 'price');
    }
    
    /**
     * @Route("/media/", name="media")
     * @Template()
    */
    public function mediaAction()
    {
        return array('page' => 'media');
    }
    
    /**
     * @Route("/album/", name="album")
     * @Template()
    */
    public function albumAction()
    {
        return array('page' => 'media');
    }
    
    /**
     * @Route("/video/", name="video")
     * @Template()
    */
    public function videoAction()
    {
        return array('page' => 'media');
    }
    
    /**
     * @Route("/achievement/", name="achievement")
     * @Template()
    */
    public function achievementAction()
    {
        return array('page' => 'achievement');
    }
    
    /**
     * @Route("/news/", name="news")
     * @Template()
    */
    public function newsAction()
    {
        return array('page' => 'news');
    }
    
    /**
     * @Route("/shows/", name="shows")
     * @Template()
    */
    public function showsAction()
    {
        return array('page' => 'shows');
    }
    
    /**
     * @Route("/contacts/", name="contacts")
     * @Template()
    */
    public function contactsAction()
    {
        return array('page' => 'contacts');
    }

}
