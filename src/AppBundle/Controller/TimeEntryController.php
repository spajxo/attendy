<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeEntry;
use Doctrine\Common\Persistence\ObjectRepository;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class TimeEntryController
 * @package ApiBundle\Controller
 */
class TimeEntryController extends FOSRestController
{
    /**
     * List all Timeentries.
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing.")
     * @QueryParam(name="limit", requirements="\d+", default="5", description="How many entities to return.")
     * @param ParamFetcher $paramFetcher
     * @View()
     * @return array
     */
    public function getTimeentriesAction(ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');

        $timeEntries = $this->getRepository()->findBy([], [], $limit, $offset);

        return ['timeEntries' => $timeEntries];
    }

    /**
     * Get timeentry of given id
     * @ApiDoc()
     * @View()
     * @param TimeEntry $timeEntry
     * @return array
     */
    public function getTimeentryAction(TimeEntry $timeEntry)
    {
        return ['timeEntry' => $timeEntry];
    }

    /**
     * @return ObjectRepository
     */
    private function getRepository(): ObjectRepository
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:TimeEntry');
    }

}
