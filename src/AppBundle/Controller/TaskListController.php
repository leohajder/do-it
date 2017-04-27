<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\TaskListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\TaskList;
use AppBundle\Entity\TaskListInterface;

/**
 * Tasklist controller.
 */
class TaskListController extends Controller
{
    /**
     * Lists all taskList entities.
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        /** @var TaskListInterface $taskLists */
        $taskLists = $this->get('app.repository.task_list')->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render('AppBundle:tasklist:index.html.twig', [
            'taskLists' => $taskLists,
        ]);
    }

    /**
     * Creates a new taskList entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        /** @var TaskListInterface $taskList */
        $taskList = $this->get('app.factory.task_list')->createNew();
        $form = $this->createForm(TaskListType::class, $taskList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskList
                ->setUser($this->getUser())
                ->setCreated(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($taskList);
            $em->flush();

            $this->addFlash('success', 'flash.task_list.create.success');

            return $this->redirectToRoute('list_show', [
                'id' => $taskList->getId(),
                ]);
        }

        return $this->render('AppBundle:tasklist:new.html.twig', [
            'taskList' => $taskList,
            'form'     => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a taskList entity.
     *
     * @param TaskList $taskList
     *
     * @return Response
     */
    public function showAction(TaskList $taskList)
    {
        $this->denyAccessUnlessGranted('VIEW', $taskList);

        $deleteForm = $this->createDeleteForm($taskList);

        return $this->render('AppBundle:tasklist:show.html.twig', [
            'taskList'    => $taskList,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing taskList entity.
     *
     * @param Request $request
     * @param TaskList $taskList
     *
     * @return Response
     */
    public function editAction(Request $request, TaskList $taskList)
    {
        $this->denyAccessUnlessGranted('EDIT', $taskList);

        $deleteForm = $this->createDeleteForm($taskList);
        $editForm = $this->createForm(TaskListType::class, $taskList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'flash.task_list.update.success');

            return $this->redirectToRoute('list_show', [
                'id' => $taskList->getId(),
            ]);
        }

        return $this->render('AppBundle:tasklist:edit.html.twig', [
            'taskList'    => $taskList,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a taskList entity.
     *
     * @param Request $request
     * @param TaskList $taskList
     *
     * @return Response
     */
    public function deleteAction(Request $request, TaskList $taskList)
    {
        $this->denyAccessUnlessGranted('DELETE', $taskList);
        
        $form = $this->createDeleteForm($taskList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($taskList);
            $em->flush();

            $this->addFlash('success', 'flash.task_list.delete.success');
        }

        return $this->redirectToRoute('app_index');
    }

    /**
     * Creates a form to delete a taskList entity.
     *
     * @param TaskList $taskList The taskList entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(TaskList $taskList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('list_delete', [
                'id' => $taskList->getId(),
            ]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
