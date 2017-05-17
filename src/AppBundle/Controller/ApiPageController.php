<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiPageController extends ApiBaseController
{
    /**
     * @Rest\Post("/page")
     * @ApiDoc(
     *     section="Page",
     *     description="Create a new page"
     * )
     */
    public function postPageAction() {}

    /**
     * @Rest\Get("/page/{page_id}")
     * @ApiDoc(
     *     section="Page",
     *     description="Get a page by his id"
     * )
     */
    public function getPageAction($page_id) {
        $page = $this->getAppRepository('Page')->find($page_id);

        if (empty($page)) {
            return new JsonResponse(['message' => 'Page not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($page);
    }

    /**
     * @Rest\Put("/page/{page_id}")
     * @ApiDoc(
     *     section="Page",
     *     description="Update a page by his id"
     * )
     */
    public function putPageAction($page_id) {}

    /**
     * @Rest\Delete("/page/{page_id}")
     * @ApiDoc(
     *     section="Page",
     *     description="Delete a page by his id"
     * )
     */
    public function deletePageAction($page_id) {}
}
