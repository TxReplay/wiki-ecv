<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiPageController extends ApiBaseController
{
    public function postPageAction() {}

    public function getPageAction($page_id) {}

    public function putPageAction($page_id) {}

    public function deletePageAction($page_id) {}
}
