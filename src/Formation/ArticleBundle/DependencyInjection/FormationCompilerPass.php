<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * */
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

 class FormationCompilerPass implements CompilerPassInterface
  {
 public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('formation.censor')) {
            return;
        }

        $definition = $container->getDefinition(
            'formation.censor'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'formation'
        );
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addFormation',
                array(new Reference($id))
            );
        }
        $container = new ContainerBuilder();
        $container->addCompilerPass(new FormationCompilerPass);
    }
    }
?>
