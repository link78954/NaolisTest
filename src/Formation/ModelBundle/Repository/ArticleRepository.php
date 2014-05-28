<?php
namespace Formation\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function activeArtByCat($cat, $limit, $offset)
    { 

        //$list=$this->_em->getRepository("FormationModelBundle:Cat")->findBy(array("isActive"=>1));
        $qba=$this->createQueryBuilder('a');

        if($cat =="all")
        {
            $qba->Select('a'); 
            $qba->Where($qba->expr()->eq('isActive', 1));
        }
        else {

            $qba->Select('a');

            $qba->Join('a.cats', 'c');

            $qba->addSelect('c');

            $qba->Where($qba->expr()->in('c', $cat));

            $qba->andWhere($qba->expr()->eq('a.isActive', 1));
        }

        $qba->setFirstResult($offset);
        $qba->setMaxResults($limit);
        
        $list = $qba->getQuery()->getResult();
        
        return $list;
    }
    
    
}