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

class ApiPageRevisionController extends FOSRestController
{
    public function postRevisionAction() {}

    public function getRevisionAction($id) {}

    public function putRevisionAction($id) {}

    public function deleteRevisionAction($id) {}

    /**
     * @return \AppBundle\Repository\PageRevisionRepository|\Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:PageRevision');

    }
}
