<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TaskList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tasklist controller.
 */
class TaskListController extends Controller
{
    /**
     * Lists all taskList entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taskLists = $em->getRepository('AppBundle:TaskList')->findAll();

        return $this->render('AppBundle:tasklist:index.html.twig', array(
            'taskLists' => $taskLists,
        ));
    }

    /**
     * Creates a new taskList entity.
     */
    public function newAction(Request $request)
    {
        $taskList = new Tasklist();
        $form = $this->createForm('AppBundle\Form\TaskListType', $taskList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taskList);
            $em->flush($taskList);

            return $this->redirectToRoute('list_show', array('id' => $taskList->getId()));
        }

        return $this->render('AppBundle:tasklist:new.html.twig', array(
            'taskList' => $taskList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a taskList entity.
     */
    public function showAction(TaskList $taskList)
    {
        $deleteForm = $this->createDeleteForm($taskList);

        return $this->render('AppBundle:tasklist:show.html.twig', array(
            'taskList' => $taskList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing taskList entity.
     */
    public function editAction(Request $request, TaskList $taskList)
    {
        $deleteForm = $this->createDeleteForm($taskList);
        $editForm = $this->createForm('AppBundle\Form\TaskListType', $taskList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_edit', array('id' => $taskList->getId()));
        }

        return $this->render('AppBundle:tasklist:edit.html.twig', array(
            'taskList' => $taskList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a taskList entity.
     */
    public function deleteAction(Request $request, TaskList $taskList)
    {
        $form = $this->createDeleteForm($taskList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($taskList);
            $em->flush();
        }

        return $this->redirectToRoute('list_index');
    }

    /**
     * Creates a form to delete a taskList entity.
     *
     * @param TaskList $taskList The taskList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TaskList $taskList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('list_delete', array('id' => $taskList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
