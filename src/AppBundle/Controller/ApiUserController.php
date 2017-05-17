<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiUserController extends ApiBaseController
{
    public function postUserAction() {}

    /**
     * @ApiDoc()
     * @Rest\Get("/user/{user_id}")
     */
    public function getUserAction($user_id)
    {
        $user = $this->getAppRepository('User')->find($user_id);

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($user);
    }

    public function putUserAction($id) {}

    public function deleteUserAction($id) {}

    public function postUserLoginAction() {}

    public function getUserLogoutAction() {}
}
