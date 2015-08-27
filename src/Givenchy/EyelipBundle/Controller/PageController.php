<?php

namespace Givenchy\EyelipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:index.html.twig');
    }

    public function photolistAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:photolist.html.twig');
    }

    public function uploadAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:upload.html.twig');
    }

    public function resultAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:result.html.twig');
    }

    public function infoAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:info.html.twig');
    }

    public function finishAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:finish.html.twig');
    }

    public function checkAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:check.html.twig');
    }

    public function userAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:user.html.twig');
    }

    public function lotteryAction()
    {
        return $this->render('GivenchyEyelipBundle:Eyelip:lottery.html.twig');
    }

    

    
}
