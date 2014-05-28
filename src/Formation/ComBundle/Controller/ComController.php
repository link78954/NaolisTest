<?php

namespace Formation\ComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Formation\ModelBundle\Form\ComType;

class ComController extends Controller
{
    public function notFromAction($user_id)
    {
        $manager=$this->getDoctrine()->getManager();
        $userRepo = $manager->getRepository('FormationModelBundle:User');
        $comRepo = $manager->getRepository('FormationModelBundle:Com');
        
        //Recup Array des users recherchés
        $qbu = $userRepo->createQueryBuilder('u');
        $qbu->Where($qbu->expr()->neq('u.id',$user_id));
        $searchUsers = $qbu->getQuery()->getResult();
        $idUser = array();
        foreach($searchUsers as $sUser){
            $idUser[]=$sUser->getId();
        }
        
        //Recup array des com des user recherchés
        $qb = $comRepo->createQueryBuilder('c');
        $qb->Where($qb->expr()->in('c.user',$idUser));
        
        $comList = $qb->getQuery()->getResult();
          
        foreach($comList as $com){
                echo("New com : <br/> Id : ");
                echo($com->getId());
                echo("<br/> Text : ");
                echo($com->getText());
                echo("<br/> Auteur : ");
                echo($com->getAuthor());
                echo("<br/>");
        }
    }
    public function createAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $com = new \Formation\ModelBundle\Entity\Com();
        
        $cForm = $this->createForm(new ComType, $com);
       
        if($this->getRequest()->getMethod()=="POST"){
            $cForm->bind($this->getRequest());
            if($cForm->isValid()){
                $manager->persist($com);
                $manager->flush();
                
                return $this->redirect($this->generateUrl('formation_article_list'));
                
            }  
        } 
        
        return $this->render('FormationComBundle:Com:create.html.twig', array('cForm'=>$cForm->createView()));

    }
            
}
