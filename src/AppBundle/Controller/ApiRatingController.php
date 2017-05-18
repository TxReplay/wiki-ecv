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
     * @ApiDoc(
     *     section="Rating",
     *     description="Create a new rating"
     * )
     */
    public function postRatingAction() {}

    /**
     * @Rest\Get("/rating/{rating_id}")
     * @ApiDoc(
     *     section="Rating",
     *     description="Get a rating by his id"
     * )
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
     * @ApiDoc(
     *     section="Rating",
     *     description="Update a rating by his id"
     * )
     */
    public function putRatingAction($rating_id) {}

    /**
     * @Rest\Delete("/rating/{rating_id}")
     * @ApiDoc(
     *     section="Rating",
     *     description="Delete a rating by his id"
     * )
     */
    public function deleteRatingAction($rating_id) {}
}
