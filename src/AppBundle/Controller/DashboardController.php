<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeEntry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 */
class DashboardController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     * @param Request $request
     * @return array|Response
     * @Template(":dashboard:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $timeEntry = new TimeEntry();
        $timeEntry->setUser($this->getUser());
        $timeEntry->setDate(new \DateTime());

        $form = $this->createForm('AppBundle\Form\TimeEntryType', $timeEntry);
        $form->handleRequest($request);

        return [
            'form' => $form->createView(),
        ];
    }
}
