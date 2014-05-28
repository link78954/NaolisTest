<?php

namespace Formation\CatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Formation\ModelBundle\Form\CatType;

class CatController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/cat/list/{limit}/{offset}/{cat}", defaults={"limit"=5,"offset"=0,"cat"="1"})
     * @Template()
     */
    public function listAction($limit, $offset, $cat)
    {
        $manager = $this->getDoctrine()->getManager();
        $catRepo = $manager->getRepository('FormationModelBundle:Cat');

        $listCat = $catRepo->activeCat(); 
        
        return $this->render('FormationCatBundle:Cat:list.html.twig',array('listCat'=>$listCat));
    }  
    
    /**
     * @Route("/cat/create")
     * @Template()
     */
    public function createAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $catRepo = $manager->getRepository("FormationModelBundle:Cat");
        
        $what = $catRepo->sayHello();
        
        var_dump($what);die;
        
        $cat = new \Formation\ModelBundle\Entity\Cat();
        
        $cForm = $this->createForm(new CatType, $cat);
        
        if($this->getRequest()->getMethod()=="POST"){
            $cForm->bind($this->getRequest());
            if($cForm->isValid()){
                $manager->persist($cat);
                foreach ($cat->getArticles() as $article)
                {
                    $article->addCat($cat);
                    $manager->persist($article);
                }
                $manager->flush();
                //$this->get('session')->getFlashBag()->add('infos','Enregistrement correctement effectué');
                return $this->redirect($this->generateUrl('formation_article_list'));
            }  
        }
        
        return $this->render('FormationCatBundle:Cat:create.html.twig', array('cForm'=>$cForm->createView()));
    }
   
    
}
