<?php

namespace AppBundle\Entity;

use AppBundle\Model\StatusInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Page
 *
 * @ORM\Table(name="page_revisions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRevisionRepository")
 */
class PageRevision implements StatusInterface
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Page
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page", inversedBy="revisions", cascade={"persist"})
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $page;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false, unique=false)
     */
    private $status = StatusInterface::STATUS_DRAFT;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false, unique=false)
     */
    private $content;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="revisions", cascade={"persist"})
     * @ORM\JoinColumn(name="update_by_user_id", referencedColumnName="id")
     */
    protected $updateBy;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="revision", cascade={"persist", "remove"})
     */
    protected $ratings;

    /////////////////////////
    // GETTERS AND SETTERS //
    /////////////////////////

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param Page $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return User
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    /**
     * @param User $updateBy
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;
    }

    /////////////////
    //  FUNCTIONS  //
    /////////////////

    public function __construct() {
        $this->ratings = new ArrayCollection();
    }

    public function setStatusOnline() { $this->status = self::STATUS_ONLINE; }
    public function setStatusPending() { $this->status = self::STATUS_PENDING; }
    public function setStatusCanceled() { $this->status = self::STATUS_CANCELED; }
    public function setStatusDraft() { $this->status = self::STATUS_DRAFT; }
}

