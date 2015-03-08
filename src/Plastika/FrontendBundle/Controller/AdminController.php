<?php

namespace Plastika\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Plastika\BusinessBundle\Entity\News;
use Plastika\BusinessBundle\Entity\Show;
use Plastika\BusinessBundle\Entity\Achieve;
use Plastika\BusinessBundle\Entity\Coach;
use Plastika\BusinessBundle\Entity\Style;
use Plastika\BusinessBundle\Entity\NewsImage;
use Plastika\BusinessBundle\Entity\NewsVideo;
use Plastika\BusinessBundle\Entity\AchieveImage;
use Plastika\BusinessBundle\Entity\AchieveVideo;
use Plastika\BusinessBundle\Entity\CoachImage;
use Plastika\BusinessBundle\Entity\CoachVideo;
use Plastika\BusinessBundle\Entity\CoachDocument;
use Plastika\BusinessBundle\Entity\StyleImage;
use Plastika\FrontendBundle\Form\NewsType;
use Plastika\FrontendBundle\Form\ShowType;
use Plastika\FrontendBundle\Form\AchieveType;
use Plastika\FrontendBundle\Form\CoachType;
use Plastika\FrontendBundle\Form\StyleType;

class AdminController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
        
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return array(
            'last_username' => $lastUsername,
            'error' => $error,
            'page' => 'login',
        );
    }
    
    /**
     * @Route("/login_check", name="security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/admin/", name="adminindex")
     * @Template()
    */
    public function indexAction()
    {
        return array('page' => 'admin');
    }
    
    /**
     * @Route("/admin/styles/", name="adminstyles")
     * @Template()
    */
    public function stylesAction()
    {
        $repository = $this->getDoctrine()->getRepository('PlastikaBusinessBundle:Style');
        $styles = $repository->findAll(); 
        return array(
            'page' => 'styles',
            'styles' => $styles,
        );
    }
    
    /**
     * @Route("/admin/style/create", name="stylecreate")
     * @Template()
    */
    public function createstyleAction(Request $request)
    {
        $style = new Style();
        $image = new StyleImage();
        $style->getImages()->add($image);
        $form = $this->createForm(new StyleType(), $style);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Style $style */
                $style = $form->getData();
                $style->setCreated(new \DateTime());
                $images = $style->getImages();
                foreach ($images as $image) {
                    $image->setStyle($style);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $em->persist($style);
                $em->flush();
                return $this->redirect($this->generateUrl('adminstyles'));
            }
        }
        return array(
            'page' => 'styles',
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/admin/style/delete/{id}", name="styledelete", requirements={"id" = "\d+"})
    */
    public function deletestyleAction(Style $style, Request $request)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($style);
       $em->flush();
       return $this->redirect($this->generateUrl('adminstyles'));
    }
    
    /**
     * @Route("/admin/style/edit/{id}", name="styleedit", requirements={"id" = "\d+"})
     * @Template()
    */
    public function editstyleAction(Style $style, Request $request)
    {
       $form = $this->createForm(new StyleType(), $style);
       if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Style $style */
                $style = $form->getData();
                $images = $style->getImages();
                foreach ($images as $image) {
                    $image->setStyle($style);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $em->persist($style);
                $em->flush();
            }
        }
        return array(
            'page' => 'styles',
            'form' => $form->createView(),
            'style' => $style,
        );
    }
    
    /**
     * @Route("/admin/coaches/", name="admincoaches")
     * @Template()
    */
    public function coachesAction()
    {
        $repository = $this->getDoctrine()->getRepository('PlastikaBusinessBundle:Coach');
        $coaches = $repository->findAll(); 
        return array(
            'page' => 'coaches',
            'coaches' => $coaches,
        );
    }
    
    /**
     * @Route("/admin/coach/create", name="coachcreate")
     * @Template()
    */
    public function createcoachAction(Request $request)
    {
        $coach = new Coach();
        $image = new CoachImage();
        $video = new CoachVideo();
        $document = new CoachDocument();
        $coach->getImages()->add($image);
        $coach->getVideo()->add($video);
        $coach->getDocuments()->add($document);
        $form = $this->createForm(new CoachType(), $coach);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Coach $coach */
                $coach = $form->getData();
                $coach->setCreated(new \DateTime());
                if (!empty($_FILES)) {
                    $coach->upload();
                }
                $images = $coach->getImages();
                foreach ($images as $image) {
                    $image->setCoach($coach);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $coach->getVideo();
                foreach ($video as $movie) {
                    $movie->setCoach($coach);
                }
                $documents = $coach->getDocuments();
                foreach ($documents as $document) {
                    $document->setCoach($coach);
                    if (!empty($_FILES)) {
                        $document->upload();
                    }
                }
                $em->persist($coach);
                $em->flush();
                return $this->redirect($this->generateUrl('admincoaches'));
            }
        }
        return array(
            'page' => 'coaches',
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/admin/coach/delete/{id}", name="coachdelete", requirements={"id" = "\d+"})
    */
    public function deletecoachAction(Coach $coach, Request $request)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($coach);
       $em->flush();
       return $this->redirect($this->generateUrl('admincoaches'));
    }
    
    /**
     * @Route("/admin/coach/edit/{id}", name="coachedit", requirements={"id" = "\d+"})
     * @Template()
    */
    public function editcoachAction(Coach $coach, Request $request)
    {
       $form = $this->createForm(new CoachType(), $coach);
       if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Coach $coach */
                $coach = $form->getData();
                if (!empty($_FILES)) {
                    $coach->upload();
                }
                $images = $coach->getImages();
                foreach ($images as $image) {
                    $image->setCoach($coach);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $coach->getVideo();
                foreach ($video as $movie) {
                    $movie->setCoach($coach);
                }
                $documents = $coach->getDocuments();
                foreach ($documents as $document) {
                    $document->setCoach($coach);
                    if (!empty($_FILES)) {
                        $document->upload();
                    }
                }
                $em->persist($coach);
                $em->flush();
            }
        }
        return array(
            'page' => 'coaches',
            'form' => $form->createView(),
            'coach' => $coach,
        );
    }
    
    /**
     * @Route("/admin/timetable/", name="admintimetable")
     * @Template()
    */
    public function timetableAction()
    {
        return array('page' => 'timetable');
    }
    
    /**
     * @Route("/admin/price/", name="adminprice")
     * @Template()
    */
    public function priceAction()
    {
        return array('page' => 'price');
    }
    
    /**
     * @Route("/admin/media/", name="adminmedia")
     * @Template()
    */
    public function mediaAction()
    {
        return array('page' => 'media');
    }
    
    /**
     * @Route("/admin/achieves/", name="adminachieves")
     * @Template()
    */
    public function achievesAction()
    {
        $repository = $this->getDoctrine()->getRepository('PlastikaBusinessBundle:Achieve');
        $achieves = $repository->findAll(); 
        return array(
            'page' => 'achieves',
            'achieves' => $achieves,
        );
    }
    
    /**
     * @Route("/admin/achieve/create", name="achievecreate")
     * @Template()
    */
    public function createachieveAction(Request $request)
    {
        $achieve = new Achieve();
        $image = new AchieveImage();
        $video = new AchieveVideo();
        $achieve->getImages()->add($image);
        $achieve->getVideo()->add($video);
        $form = $this->createForm(new AchieveType(), $achieve);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Achieve $achieve */
                $achieve = $form->getData();
                $achieve->setCreated(new \DateTime());
                $images = $achieve->getImages();
                foreach ($images as $image) {
                    $image->setAchieve($achieve);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $achieve->getVideo();
                foreach ($video as $movie) {
                    $movie->setAchieve($achieve);
                }
                $em->persist($achieve);
                $em->flush();
                return $this->redirect($this->generateUrl('adminachieves'));
            }
        }
        return array(
            'page' => 'achieves',
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/admin/achieve/delete/{id}", name="achievedelete", requirements={"id" = "\d+"})
    */
    public function deleteachieveAction(Achieve $achieve, Request $request)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($achieve);
       $em->flush();
       return $this->redirect($this->generateUrl('adminachieves'));
    }
    
    /**
     * @Route("/admin/achieve/edit/{id}", name="achieveedit", requirements={"id" = "\d+"})
     * @Template()
    */
    public function editachieveAction(Achieve $achieve, Request $request)
    {
       $form = $this->createForm(new AchieveType(), $achieve);
       if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Achieve $achieve */
                $achieve = $form->getData();
                $images = $achieve->getImages();
                foreach ($images as $image) {
                    $image->setAchieve($achieve);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $achieve->getVideo();
                foreach ($video as $movie) {
                    $movie->setAchieve($achieve);
                }
                $em->persist($achieve);
                $em->flush();
            }
        }
        return array(
            'page' => 'achieves',
            'form' => $form->createView(),
            'achieve' => $achieve,
        );
    }
    
    /**
     * @Route("/admin/news/", name="adminnews")
     * @Template()
    */
    public function newsAction()
    {
       $repository = $this->getDoctrine()->getRepository('PlastikaBusinessBundle:News');
       $news = $repository->findAll(); 
       return array(
           'page' => 'news',
           'news' => $news,
       );
    }
    
    /**
     * @Route("/admin/news/create", name="newscreate")
     * @Template()
    */
    public function createnewsAction(Request $request)
    {
        $news = new News();
        $image = new NewsImage();
        $video = new NewsVideo();
        $news->getImages()->add($image);
        $news->getVideo()->add($video);
        $form = $this->createForm(new NewsType(), $news);
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var News $news */
                $news = $form->getData();
                $news->setCreated(new \DateTime());
                $images = $news->getImages();
                foreach ($images as $image) {
                    $image->setNews($news);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $news->getVideo();
                foreach ($video as $movie) {
                    $movie->setNews($news);
                }
                $em->persist($news);
                $em->flush();
                return $this->redirect($this->generateUrl('adminnews'));
            }
        }
        return array(
            'page' => 'news',
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/admin/news/delete/{id}", name="newsdelete", requirements={"id" = "\d+"})
    */
    public function deletenewsAction(News $news, Request $request)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($news);
       $em->flush();
       return $this->redirect($this->generateUrl('adminnews'));
    }
    
    /**
     * @Route("/admin/news/edit/{id}", name="newsedit", requirements={"id" = "\d+"})
     * @Template()
    */
    public function editnewsAction(News $news, Request $request)
    {
       $form = $this->createForm(new NewsType(), $news);
       if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var News $news */
                $news = $form->getData();
                $images = $news->getImages();
                foreach ($images as $image) {
                    $image->setNews($news);
                    if (!empty($_FILES)) {
                        $image->upload();
                    }
                }
                $video = $news->getVideo();
                foreach ($video as $movie) {
                    $movie->setNews($news);
                }
                $em->persist($news);
                $em->flush();
            }
        }
        return array(
            'page' => 'news',
            'form' => $form->createView(),
            'news' => $news,
        );
    }
    
    /**
     * @Route("/admin/shows/", name="adminshows")
     * @Template()
    */
    public function showsAction()
    {
        $repository = $this->getDoctrine()->getRepository('PlastikaBusinessBundle:Show');
        $shows = $repository->findAll();
        return array(
            'page' => 'shows',
            'shows' => $shows,
        );
    }
    
    /**
     * @Route("/admin/show/create", name="showcreate")
     * @Template()
    */
    public function createshowAction(Request $request)
    {
        $form = $this->createForm(new ShowType());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Show $show */
                $show = $form->getData();
                $show->setCreated(new \DateTime());
                $em->persist($show);
                $em->flush();
                return $this->redirect($this->generateUrl('adminshows'));
            }
        }
        return array(
            'page' => 'shows',
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/admin/show/delete/{id}", name="showdelete", requirements={"id" = "\d+"})
    */
    public function deleteshowAction(Show $show, Request $request)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($show);
       $em->flush();
       return $this->redirect($this->generateUrl('adminshows'));
    }
    
    /**
     * @Route("/admin/show/edit/{id}", name="showedit", requirements={"id" = "\d+"})
     * @Template()
    */
    public function editshowAction(Show $show, Request $request)
    {
       $form = $this->createForm(new ShowType(), $show);
       if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /** @var Show $show */
                $show = $form->getData();
                $em->persist($show);
                $em->flush();
            }
        }
        return array(
            'page' => 'shows',
            'form' => $form->createView(),
            'show' => $show,
        );
    }
}
