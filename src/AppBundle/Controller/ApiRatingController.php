<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiRatingController extends ApiBaseController
{
    /**
     * @Rest\Post("/rating")
     * @ApiDoc()
     */
    public function postRatingAction() {}

    /**
     * @Rest\Get("/rating/{rating_id}")
     * @ApiDoc()
     */
    public function getRatingAction($rating_id) {
        $rating = $this->getAppRepository('Rating')->find($rating_id);

        if (empty($rating)) {
            return new JsonResponse(['message' => 'Rating not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($rating);
    }

    /**
     * @Rest\Put("/rating/{rating_id}")
     * @ApiDoc()
     */
    public function putRatingAction($rating_id) {}

    /**
     * @Rest\Delete("/rating/{rating_id}")
     * @ApiDoc()
     */
    public function deleteRatingAction($rating_id) {}
}
