<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeEntry;
use AppBundle\Model\TimeEntryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Timeentry controller.
 * @Route("timeentry")
 */
class TimeEntryController extends Controller
{
    /**
     * Lists all timeEntry entities.
     * @Route("/", name="timeentry_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $timeEntries = $em->getRepository('AppBundle:TimeEntry')->findAll();

        return array(
            'timeEntries' => $timeEntries,
        );
    }

    /**
     * Creates a new timeEntry entity.
     * @Route("/new", name="timeentry_new")
     * @Method({"GET", "POST"})
     * @Template()
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request)
    {
        $timeEntry = new Timeentry();
        $form = $this->createForm('AppBundle\Form\TimeEntryType', $timeEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeEntry);
            $em->flush();

            return $this->redirectToRoute('timeentry_show', array('id' => $timeEntry->getId()));
        }

        return array(
            'timeEntry' => $timeEntry,
            'form' => $form->createView(),

        );
    }

    /**
     * Finds and displays a timeEntry entity.
     * @Route("/{id}", name="timeentry_show")
     * @Method("GET")
     * @Template()
     * @param TimeEntryInterface $timeEntry
     * @return array
     */
    public function showAction(TimeEntryInterface $timeEntry)
    {
        $deleteForm = $this->createDeleteForm($timeEntry);

        return array(
            'timeEntry' => $timeEntry,
            'delete_form' => $deleteForm->createView(),

        );
    }

    /**
     * Displays a form to edit an existing timeEntry entity.
     * @Route("/{id}/edit", name="timeentry_edit")
     * @Method({"GET", "POST"})
     * @param Request            $request
     * @param TimeEntryInterface $timeEntry
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Template()
     */
    public function editAction(Request $request, TimeEntryInterface $timeEntry)
    {
        $deleteForm = $this->createDeleteForm($timeEntry);
        $editForm = $this->createForm('AppBundle\Form\TimeEntryType', $timeEntry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timeentry_edit', array('id' => $timeEntry->getId()));
        }

        return array(
            'timeEntry' => $timeEntry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        );
    }

    /**
     * Deletes a timeEntry entity.
     * @Route("/{id}", name="timeentry_delete")
     * @Method("DELETE")
     * @param Request            $request
     * @param TimeEntryInterface $timeEntry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, TimeEntryInterface $timeEntry)
    {
        $form = $this->createDeleteForm($timeEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeEntry);
            $em->flush();
        }

        return $this->redirectToRoute('timeentry_index');
    }

    /**
     * Creates a form to delete a timeEntry entity.
     * @param TimeEntryInterface $timeEntry The timeEntry entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TimeEntryInterface $timeEntry)
    {
        return $this->createFormBuilder()->setAction(
            $this->generateUrl('timeentry_delete', array('id' => $timeEntry->getId()))
        )->setMethod('DELETE')->getForm();
    }
}
