<?php

namespace AppBundle\Controller;

use AppBundle\Controller\ApiController;

class ApiRatingController extends ApiController
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
