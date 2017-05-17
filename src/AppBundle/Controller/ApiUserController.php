<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiUserController extends ApiBaseController
{
    /**
     * @Rest\Post("/user/register")
     * @ApiDoc(
     *     section="User",
     *     description="Register a new user.",
     *     requirements={
     *          { "name"="email", "dataType"="string" },
     *          { "name"="username", "dataType"="string" },
     *          { "name"="password", "dataType"="string" }
     *     },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         409 = "Returned when the email/username is already used",
     *     }
     * )
     */
    public function postUserAction(Request $request)
    {
        $data = $request->request->all();

        $userManager = $this->get('fos_user.user_manager');

        if ($userManager->findUserByEmail($data['email'])) {
            return new JsonResponse(['message' => 'Email already used'], Response::HTTP_CONFLICT);
        }

        if ($userManager->findUserByUsername($data['username'])) {
            return new JsonResponse(['message' => 'Username already used'], Response::HTTP_CONFLICT);
        }

        $user = $userManager->createUser();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPlainPassword($data['password']);
        $user->setEnabled(true);

        $userManager->updateUser($user);

        return [];
    }

    /**
     * @Rest\Get("/user/{user_id}")
     * @ApiDoc(
     *     section="User",
     *     description="Retrieve an user by his id",
     *     parameters={
     *          {"name"="user_id", "dataType"="integer", "required"=true, "description"="User id"}
     *     },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         409 = "Returned when the email/username is already used",
     *     }
     * )
     */
    public function getUserAction($user_id)
    {
        $user = $this->getAppRepository('User')->find($user_id);

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($user);
    }

    /**
     * @Rest\Put("user/{user_id}")
     * @ApiDoc(
     *     section="User",
     *     description="Update an user by his id"
     * )
     */
    public function putUserAction($user_id) {}

    /**
     * @Rest\Delete("user/{user_id}")
     * @ApiDoc(
     *     section="User",
     *     description="Delete an user by his id"
     * )
     */
    public function deleteUserAction($user_id) {
        $user = $this->getAppRepository('User')->find($user_id);

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $id = $user->getId();
        $username = $user->getUsername();

        $this->getAppManager()->remove($user);
        $this->getAppManager()->flush();

        return new JsonResponse(['message' => 'User with id n°'.$id.'('.$username.') has been deleted.'], Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\Post("/user/login")
     * @ApiDoc(
     *     section="User",
     *     description="Login an user"
     * )
     */
    public function postUserLoginAction() {}

    /**
     * @Rest\Get("/user/logout")
     * @ApiDoc(
     *     section="User",
     *     description="Logout an user by his id"
     * )
     */
    public function getUserLogoutAction() {}
}
