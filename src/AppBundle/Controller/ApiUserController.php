<?php

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;


class ApiUserController extends FOSRestController
{
    public function postUserAction() {}

    /**
     * @param Request $request
     * @return array|JsonResponse
     * @ApiDoc(
     *  description="Returns an user",
     *  requirements={
     *      {
     *          "name"="user_id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="User ID"
     *      }
     *  }
     * )
     * @Rest\View()
     * @Rest\Get("/user/{user_id}")
     */
    public function getUserAction(Request $request)
    {
        $user = $this->getUserRepository()->find($request->get('user_id'));

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ];
    }

    public function putUserAction($id) {}

    public function deleteUserAction($id) {}

    public function postUserLoginAction() {}

    public function getUserLogoutAction() {}

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:User');

    }
}
