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

class ApiPageController extends FOSRestController
{
    public function postPageAction() {}

    public function getPageAction($id) {}

    public function putPageAction($id) {}

    public function deletePageAction($id) {}

    /**
     * @return \AppBundle\Repository\PageRepository|\Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Page');

    }
}
