<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiPageRevisionController extends ApiBaseController
{
    /**"
     * @Rest\Post("/revision")
     * @ApiDoc()
     */
    public function postRevisionAction() {}

    /**"
     * @Rest\Get("/revision/{revision_id}")
     * @ApiDoc()
     */
    public function getRevisionAction($revision_id)
    {
        $revision = $this->getAppRepository('PageRevision')->find($revision_id);

        if (empty($revision)) {
            return new JsonResponse(['message' => 'Revision not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($revision);
    }

    /**"
     * @Rest\Put("/revision/{revision_id}")
     * @ApiDoc()
     */
    public function putRevisionAction($revision_id) {}

    /**"
     * @Rest\Delete("/revision/{revision_id}")
     * @ApiDoc()
     */
    public function deleteRevisionAction($revision_id) {}
}
