<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
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
    public function postPageAction(Request $request) {
        $data = $request->request->all();

        $page = new Page();
        $page->setTitle($data['title']);

        $this->getAppManager()->persist($page);
        $this->getAppManager()->flush();

        return new JsonResponse(['message' => 'Page successfully created'], Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\Get("/page/{page_slug}")
     * @ApiDoc(
     *     section="Page",
     *     description="Get a page by his slug"
     * )
     */
    public function getPageAction($page_slug) {
        $page = $this->getAppRepository('Page')->findOneBy(['slug' => $page_slug]);

        if (empty($page)) {
            return new JsonResponse(['message' => 'Page not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($page);
    }

    /**
     * @Rest\Put("/page/{page_slug}")
     * @ApiDoc(
     *     section="Page",
     *     description="Update a page by his slug"
     * )
     */
    public function putPageAction($page_slug) {}

    /**
     * @Rest\Delete("/page/{page_slug}")
     * @ApiDoc(
     *     section="Page",
     *     description="Delete a page by his slug"
     * )
     */
    public function deletePageAction($page_slug) {}
}
