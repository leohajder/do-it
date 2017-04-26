<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Default controller.
 */
class DefaultController extends Controller
{
    /**
     * Lists all task entities.
     *
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:default:about.html.twig');
    }
}
