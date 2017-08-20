<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeEntry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @return array|RedirectResponse
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\TimeEntryType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeEntry = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeEntry);
            $em->flush();

            return $this->redirectToRoute('timeentry_show', array('id' => $timeEntry->getId()));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a timeEntry entity.
     * @Route("/{id}", name="timeentry_show")
     * @Method("GET")
     * @Template()
     * @param TimeEntry $timeEntry
     * @return array
     */
    public function showAction(TimeEntry $timeEntry)
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
     * @param Request   $request
     * @param TimeEntry $timeEntry
     * @return array|RedirectResponse
     * @Template()
     */
    public function editAction(Request $request, TimeEntry $timeEntry)
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
     * @param Request   $request
     * @param TimeEntry $timeEntry
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, TimeEntry $timeEntry)
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
     * @param TimeEntry $timeEntry The timeEntry entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TimeEntry $timeEntry)
    {
        return $this->createFormBuilder()->setAction(
            $this->generateUrl('timeentry_delete', array('id' => $timeEntry->getId()))
        )->setMethod('DELETE')->getForm();
    }
}
