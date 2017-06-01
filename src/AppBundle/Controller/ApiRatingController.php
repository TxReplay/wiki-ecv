<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rating;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiRatingController extends ApiBaseController
{
    /**
     * @Rest\Post("/page/{page_slug}/revision/{revision_id}/rate")
     * @ApiDoc(
     *     section="Rating",
     *     description="Create a new rating"
     * )
     */
    public function postRatingAction(Request $request, $page_slug, $revision_id) {
        $data = $request->request->all();
        $page = $this->getAppRepository('Page')->findOneBySlug($page_slug);
        $revision = $this->getAppRepository('PageRevision')->findOneBy(['id' => $revision_id, 'page' => $page]);
        $user = $this->getAppRepository('User')->find($data['user_id']);

        $rating = new Rating();
        $rating->setRevision($revision);
        $rating->setRating($data['rating']);
        $rating->setUser($user);

        $this->getAppManager()->persist($rating);
        $this->getAppManager()->flush();

        return $this->serialize($rating);
    }

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
     * @Rest\Patch("/page/{page_slug}/revision/{revision_id}/rate/{rating_id}")
     * @ApiDoc(
     *     section="Rating",
     *     description="Update a rating by his id"
     * )
     */
    public function patchRatingAction(Request $request, $page_slug, $revision_id, $rating_id) {
        $data = $request->request->all();
        $page = $this->getAppRepository('Page')->findOneBySlug($page_slug);
        $revision = $this->getAppRepository('PageRevision')->findOneBy(['id' => $revision_id, 'page' => $page]);
        $user = $this->getAppRepository('User')->find($data['user_id']);
        $rating = $this->getAppRepository('Rating')->findOneBy(['id' => $rating_id, 'revision' => $revision, 'user' => $user ]);

        $rating->setRating($data['rating']);

        $this->getAppManager()->persist($rating);
        $this->getAppManager()->flush();

        return $this->serialize($rating);
    }

    /**
     * @Rest\Delete("/rating/{rating_id}")
     * @ApiDoc(
     *     section="Rating",
     *     description="Delete a rating by his id"
     * )
     */
    public function deleteRatingAction($rating_id) {
        $rating = $this->getAppRepository('Rating')->find($rating_id);

        if (empty($rating)) {
            return new JsonResponse(['message' => 'Rating not found'], Response::HTTP_NOT_FOUND);
        }

        $this->getAppManager()->remove($rating);
        $this->getAppManager()->flush();

        return new JsonResponse(['message' => 'Rating successfully deleted.'], Response::HTTP_ACCEPTED);
    }
}
