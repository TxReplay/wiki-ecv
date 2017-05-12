<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;

class ApiRatingController extends FOSRestController
{
    public function postRatingAction() {}

    public function getRatingAction($id) {}

    public function putRatingAction($id) {}

    public function deleteRatingAction($id) {}

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Rating');

    }
}
