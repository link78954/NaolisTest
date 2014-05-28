<?php

namespace Formation\ArticleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FormationArticleBundle extends Bundle
{
    public function build(ContainerBuilder $container){
        parent::build($container);
        $container->addCompilerPass(new CustomCompilerPass());
    }
}
