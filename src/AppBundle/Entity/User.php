<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PageRevision", mappedBy="updateBy", cascade={"persist", "remove"})
     */
    protected $revisions;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection
     */
    public function getRevisions()
    {
        return $this->revisions;
    }

    /**
     * @param ArrayCollection $revisions
     */
    public function setRevisions($revisions)
    {
        $this->revisions = $revisions;
    }


    /////////////////
    //  FUNCTIONS  //
    /////////////////

    public function __construct()
    {
        parent::__construct();
        $this->revisions = new ArrayCollection();
    }
}