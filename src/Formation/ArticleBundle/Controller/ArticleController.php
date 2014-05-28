<?php

namespace Formation\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Formation\ModelBundle\Form\ArticleType;
use Symfony\Component\Config\Definition\Exception\Exception;

class ArticleController extends Controller
{
    public function indexAction($name){
        return $this->render('FormationArticleBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function readAction($id){
        if($id == ""){
            throw $this->createNotFoundException();
        }
        $manager = $this->getDoctrine()->getManager();
        $articleRepo = $manager->getRepository('FormationModelBundle:Article');
        $comRepo = $manager->getRepository('FormationModelBundle:Com');
        
        $myService = $this->get('formation.censor');
        
        $articleRead = $articleRepo->find($id);
        
        $comList = $comRepo->comByArt($id);
        
        return $this->render('FormationArticleBundle:Article:read.html.twig', array('Article'=>$articleRead,'listCom'=>$comList));
    }

    public function listAction($limit,$offset,$cat){
        
        $manager = $this->getDoctrine()->getManager();
        $articleRepo = $manager->getRepository('FormationModelBundle:Article');

        
        $listArticle = $articleRepo->activeArtByCat($cat,$limit,$offset);

        $allArticle = $articleRepo->findAll(); 
        
        return $this->render('FormationArticleBundle:Article:list.html.twig', array('listArticle'=>$listArticle,'limit'=>$limit,'offset'=>$offset,'allArticle'=>$allArticle,'cat'=>$cat));
    }
    
    public function createAction(){
        $manager = $this->getDoctrine()->getManager();
        
        $article = new \Formation\ModelBundle\Entity\Article();
        
        $aForm = $this->createForm(new ArticleType, $article);
        
        $Censor = $this->get('formation.censor');
        
        if($this->getRequest()->getMethod()=="POST"){
            $aForm->bind($this->getRequest());
            if($aForm->isValid()){
                $badWords = $Censor->isConform($article->getText());
                if(count($badWords) > 0){
                        $article->setText($Censor->censorText($badWords, $article->getText()));
                    }
                if($Censor->doesExist($article->getAuthor(), 'author', 'article')){
                    throw new \Exception("Et bim, l'auteur existe déja");
                }
                if($Censor->doesExist($article->getName(), 'name', 'article')){
                    throw new \Exception("Et bim, le titre  existe déja");
                }                
                $manager->persist($article);
                $manager->flush();

                return $this->redirect($this->generateUrl('formation_article_list'));
            }  
        }
        
        return $this->render('FormationArticleBundle:Article:create.html.twig', array('aForm'=>$aForm->createView()));
        }
    
    public function updateAction($id){
        if($id == ""){
            throw $this->createNotFoundException();
        }
        $manager = $this->getDoctrine()->getManager();
        $articleRepo = $manager->getRepository('FormationModelBundle:Article');
        
        $article = $articleRepo->find($id);

        $afb = $this->createFormBuilder($article);

        $afb->add('name','text');
        $afb->add('text','textarea');
        $afb->add('author','text');
        $afb->add('isActive','checkbox');
        $afb->add('datePublicatione', 'date');
        $afb->add('Changer', 'submit');
        
        $aForm = $afb->getForm();
        
        if($this->getRequest()->getMethod()=="POST"){
            $aForm->bind($this->getRequest());
            if($aForm->isValid()){
                $manager->persist($article);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('infos','Enregistrement correctement effectué');
                
                return $this->redirect($this->generateUrl('formation_article_list'));
            }  
        }
        
        return $this->render('FormationArticleBundle:Article:update.html.twig', array('aForm'=>$aForm->createView()));

    }

    public function deleteAction($id){
        if($id == ""){
            throw $this->createNotFoundException();
        }
        $manager = $this->getDoctrine()->getManager();
        $articleRepo = $manager->getRepository('FormationModelBundle:Article');
        
        $articleToDelete = $articleRepo->find($id);
        $manager->remove($articleToDelete);
        
        $manager->flush();
        
        return $this->render();
    }
    
    public function plopAction(){
        return $this->render('FormationArticleBundle:Article:plop.html.twig');
    }
    
}
