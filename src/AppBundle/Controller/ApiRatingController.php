<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiRatingController extends ApiBaseController
{
    public function postRatingAction() {}

    /**
     * @param Request $request
     * @return array|JsonResponse
     * @ApiDoc()
     * @Rest\View()
     * @Rest\Get("/user/{user_id}")
     */
    public function getRatingAction(Request $request) {
        $rating = $this->getUserRepository()->find($request->get('rating_id'));

        dump($rating);
        die();

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ];
    }

    public function putRatingAction($id) {}

    public function deleteRatingAction($id) {}
}
