<?php

namespace AppBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use FOS\RestBundle\Controller\FOSRestController;

class ApiBaseController extends FOSRestController
{
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getAppRepository($entity)
    {
        return $this->getAppManager()->getRepository('AppBundle:'.$entity);

    }

    protected function getAppManager()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    protected function serialize($object)
    {
        $serializer = SerializerBuilder::create()->build();
        $jsonObject = $serializer->serialize($object, 'json');

        return json_decode($jsonObject, true);
    }
}