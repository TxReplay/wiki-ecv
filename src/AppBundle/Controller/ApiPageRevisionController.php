<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Entity\PageRevision;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiPageRevisionController extends ApiBaseController
{
    /**
     * @Rest\Post("/page/{page_slug}/revision")
     * @ApiDoc(
     *     section="Revision",
     *     description="Create a new revision"
     * )
     */
    public function postRevisionAction(Request $request, $page_slug) {
        $data = $request->request->all();
        $page = $this->getAppRepository('Page')->findOneBy(['slug' => $page_slug]);

        //TODO: Get a real user
        $user = $this->getAppRepository('User')->find(1);

        $revision = new PageRevision();
        $revision->setPage($page);
        $revision->setContent($data['content']);
        $revision->setUpdateBy($user);
        
        $this->getAppManager()->persist($revision);
        $this->getAppManager()->flush();

        return new JsonResponse(['message' => 'Revision successfully created'], Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\Get("/page/{page_slug}/revision/{revision_id}")
     * @ApiDoc(
     *     section="Revision",
     *     description="Get a revision by his id"
     * )
     */
    public function getRevisionAction($page_slug, $revision_id)
    {
        $page = $this->getAppRepository('Page')->findOneBy(['slug' => $page_slug]);
        $revision = $this->getAppRepository('PageRevision')->findOneBy(['page' => $page, 'id' => $revision_id]);

        if (empty($revision)) {
            return new JsonResponse(['message' => 'Revision not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->serialize($revision);
    }

    /**
     * @Rest\Put("/page/{page_slug}/revision/{revision_id}")
     * @ApiDoc(
     *     section="Revision",
     *     description="Update a revision by his id"
     * )
     */
    public function putRevisionAction($revision_id) {}

    /**
     * @Rest\Delete("/page/{page_slug}/revision/{revision_id}")
     * @ApiDoc(
     *     section="Revision",
     *     description="Delete a revision by his id"
     * )
     */
    public function deleteRevisionAction($revision_id) {}
}
