<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;

class ApiRatingController extends FOSRestController
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

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Rating');

    }
}
