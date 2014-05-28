<?php
namespace Formation\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ComRepository extends EntityRepository
{   
    public function comByArt($art)
    {
       return $this->_em->getRepository("FormationModelBundle:Com")->findBy(array("article"=>$art));
    }    
}