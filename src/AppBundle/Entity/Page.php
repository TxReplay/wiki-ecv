<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Page
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 */
class Page
{
    use ORMBehaviors\Timestampable\Timestampable,
        ORMBehaviors\Sluggable\Sluggable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false, unique=true)
     */
    private $title;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PageRevision", mappedBy="page", cascade={"persist", "remove"})
     */
    protected $revisions;


    /////////////////////////
    // GETTERS AND SETTERS //
    /////////////////////////

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

    public function __construct() {
        $this->revisions = new ArrayCollection();
    }

    public function __toString() {
        return (!empty($this->title))? $this->title : 'Nouvelle page';
    }

    public function getSluggableFields() {
        return [ 'title' ];
    }
}

