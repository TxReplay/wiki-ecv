<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/%api_version%")
 */
class ApiController extends Controller
{
    /**
     * @Route("/user/", name="api_user")
     */
    public function indexAction(Request $request)
    {
        return new JsonResponse();
    }
}