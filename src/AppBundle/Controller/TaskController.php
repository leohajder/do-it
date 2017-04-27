<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Task;
use AppBundle\Entity\TaskInterface;
use AppBundle\Entity\TaskListInterface;

/**
 * Task controller.
 */
class TaskController extends Controller
{
    /**
     * Lists all task entities.
     *
     * @return Response
     */
    public function indexAction()
    {
        /** @var TaskInterface[] $tasks */
        $tasks = $this->get('app.repository.task')->findAll();

        return $this->render('AppBundle:task:index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Creates a new task entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        /** @var TaskInterface $task */
        $task = $this->get('app.factory.task')->createNew();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreated(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'flash.task.create.success');

            return $this->redirectToRoute('task_show', [
                'id' => $task->getId(),
            ]);
        }

        return $this->render('AppBundle:task:new.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a task entity.
     *
     * @param Task $task
     *
     * @return Response
     */
    public function showAction(Task $task)
    {
        $this->denyAccessUnlessGranted('VIEW', $task);

        $deleteForm = $this->createDeleteForm($task);

        return $this->render('AppBundle:task:show.html.twig', [
            'task'        => $task,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing task entity.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function editAction(Request $request, Task $task)
    {
        $this->denyAccessUnlessGranted('EDIT', $task);

        $deleteForm = $this->createDeleteForm($task);
        $editForm = $this->createForm(TaskType::class, $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','flash.task.update.success');

            return $this->redirectToRoute('task_show', [
                'id' => $task->getId(),
            ]);
        }

        return $this->render('AppBundle:task:edit.html.twig', [
            'task'        => $task,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a task entity.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function deleteAction(Request $request, Task $task)
    {
        $this->denyAccessUnlessGranted('DELETE', $task);

        if (false === ($this->getUser() === $task->getList()->getUser())) {
            return $this->redirectToRoute('app_index');
        }
        
        /** @var TaskListInterface $taskList */
        $taskList = $task->getList();

        $form = $this->createDeleteForm($task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();

            $this->addFlash('success','flash.task.delete.success');
        }

        return $this->redirectToRoute('list_show', [
            'id' => $taskList->getId(),
        ]);
    }

    /**
     * Creates a form to delete a task entity.
     *
     * @param TaskInterface $task The task entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(TaskInterface $task)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', [
                'id' => $task->getId(),
            ]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
