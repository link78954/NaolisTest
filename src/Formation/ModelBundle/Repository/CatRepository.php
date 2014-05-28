<?php
namespace Formation\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CatRepository extends EntityRepository
{
    public function activeCat()
    {
        $list=$this->_em->getRepository("FormationModelBundle:Cat")->findBy(array("isActive"=>1));
        return $list;
    }
    
    
}