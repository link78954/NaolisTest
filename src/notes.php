<?php

// objet request
$request = $this->getRequest();
$request->query->get('param');

$request->request->get('param');

$request->attributes->get('param');

$request->getMethod();

$request->isXmlHttpRequest();

// objet response

$this->render();


// sessions

$session = new Session();
$session->start();
$session->set('att','val');
$session->get('att');
// a bannir : pas d'application en session


// Message 'flash'





/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

