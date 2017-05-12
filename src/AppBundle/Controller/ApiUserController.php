<?php

namespace AppBundle\Controller;

use AppBundle\Controller\ApiController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiUserController extends ApiController
{
    public function postUserAction() {}

    public function getUserAction($id) {
        return new JsonResponse(['id' => $id]);
    }

    public function putUserAction($id) {}

    public function deleteUserAction($id) {}

    public function postUserLoginAction() {}

    public function getUserLogoutAction() {}

}
