<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeEntry;
use DateTime;
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
        $date = new DateTime($request->get('date'));

        $timeEntry = $this->getDoctrine()->getRepository('AppBundle:TimeEntry')->findOneBy(
            ['user' => $this->getUser(), 'date' => $date]
        );

        if (!$timeEntry) {
            $timeEntry = new TimeEntry($this->getUser(), $date);
        }

        $form = $this->createForm('AppBundle\Form\TimeEntryType', $timeEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeEntry = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($timeEntry);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
