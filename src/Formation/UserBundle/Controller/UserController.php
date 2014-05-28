<?php

namespace Formation\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $userRepo = $manager->getRepository('FormationModelBundle:User');
        
        $listUser = $userRepo->findAll();
        
        foreach ($listUser as $user){
            echo("New user : <br/> Id : ");
            echo($user->getId());
            echo("<br/> Nom : ");
            echo($user->getName());
            echo("<br/> Prenom : ");
            echo($user->getFirstname());
            echo("<br/>");
        } 
        return $this->render();        
    }
    
    public function listArticleAction($user_id)
    {
        $manager = $this->getDoctrine()->getManager();
        $articleRepo = $manager->getRepository('FormationModelBundle:Article');
        $userRepo = $manager->getRepository('FormationModelBundle:User');
        
        $userSearch = $userRepo->find($user_id);
        $listArtcile = $articleRepo->findByUser($userSearch);
        
        foreach ($listArtcile as $article){
            echo("New article : <br/> Id : ");
            echo($article->getId());
            echo("<br/> Nom : ");
            echo($article->getName());
            echo("<br/> Texte : ");
            echo($article->getText());
            echo("<br/>");
        } 
        return $this->render();        
    }

    public function listComsNotFromAction($user_id)
    {
        $manager = $this->getDoctrine()->getManager();
        $comRepo = $manager->getRepository('FormationModelBundle:Com');
        $userRepo = $manager->getRepository('FormationModelBundle:User');
        
        $userNotSearch = $userRepo->find($user_id);
        $users = $userRepo->findAll();
        
        foreach($users as $activeUser){
            if ($activeUser != $userNotSearch){
                $listCom = $comRepo->findByUser($activeUser);
        
                foreach ($listCom as $com){
                    echo("New com : <br/> Id : ");
                    echo($com->getId());
                    echo("<br/> Text : ");
                    echo($com->getText());
                    echo("<br/> Auteur : ");
                    echo($com->getAuthor());
                    echo("<br/>");
                } 
            }
        }
        
        return $this->render();        
    }
    
    public function detailAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $userRepo = $manager->getRepository('FormationModelBundle:User');
        
        $user = $userRepo->find($id);
        
        return $this->render('FormationUserBundle:User:detail.html.twig', array('User'=>$user));
    }
    
}
