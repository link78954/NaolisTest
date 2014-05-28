<?php

namespace Formation\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FormationUserBundle extends Bundle
{
    
    public function getParent(){
        return 'FOSUserBundle';
    }
}
