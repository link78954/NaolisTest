<?php

namespace Formation\ArticleBundle\Censor;

use Doctrine\ORM\EntityManager;

class Censor {
    
    protected $badWord =['con','fuck','salope'];
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function isConform($text)
    {
        return $this->searchBadWords($text);
    }
    
    protected function searchBadWords($text)
    {   
        $badWordFound = array();
        
        foreach($this->badWord as $bad)
        {
            if(preg_match('/'.$bad.'/i', $text))
            {
                $badWordFound[]=$bad;
                //return false;
            }
        }
        
        return $badWordFound;
    }
    
    public function censorText($badWords, $text)
    {
        return $this->replaceInText($this->createReplace ($badWords), $text);
    }
    
    private function createReplace ($badWords)
    {
        $replaceArray = array();
        
        foreach($badWords as $badWord)
        {
            $replace = '';
            for ($i = 0; $i < strlen($badWord);$i++)
            {
                $replace .= '*';
            }
            $replaceArray[$badWord]= $replace;
        }
        return $replaceArray;
    }
    
    private function replaceInText($replaceTexts, $text)
    {
        foreach($replaceTexts as $badWord=>$replaceText)
        {
            $text = str_replace($badWord, $replaceText, $text);
        }
        
        return $text;
    }
    
    public function doesExist($search, $field, $entity)
    {
        $localRepo = $this->em->getRepository("FormationModelBundle:".$entity);
        
        $result = $localRepo->findBy(array($field => $search));
        
        if (count($result)>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}