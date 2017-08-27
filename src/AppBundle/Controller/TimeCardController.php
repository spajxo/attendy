<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeCard;
use AppBundle\Entity\TimeEntry;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TimeCardController
 * @package AppBundle\Controller
 */
class TimeCardController extends Controller
{

    /**
     * @param Request $request
     * @return array
     * @Route("timecard/", name="timecard_index")
     * @Template()
     */
    public function indexAction(Request $request): array
    {
        $monthString = $request->get('month') ?: 'midnight first day of this month';
        $month = new DateTime($monthString);

        $repo = $this->getDoctrine()->getRepository(TimeEntry::class);
        $timeEntries = $repo->findAllInMonth($month);

        $timeCard = new TimeCard($month, $timeEntries);

        return [
            'month' => $month,
            'timeCard' => $timeCard,
        ];
    }

}
