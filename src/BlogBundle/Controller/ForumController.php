<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Controller;

use BlogBundle\Entity\Entities\Forum;
use BlogBundle\Form\ForumForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ForumController
 *
 * @author kimo
 */
class ForumController extends Controller {

    //put your code here

    public function viewAction($categoryId = NULL) {

	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Forum');

	if ($categoryId == NULL) {

	    $forumList = $repository->findAll();
	} else {

	    $forumList = $repository->findByCategory($categoryId);
	}

	return $this->render('BlogBundle:Blog\Forum:view.html.twig', array(
		    'forumList' => $forumList, 'categoryId' => $categoryId,
	));
    }

    public function addEditAction($categoryId = NULL, $forumId = NULL) {

	if ($forumId == NULL) {

	    $forum = new Forum();
	    $editFlag = FALSE;
	} else {

	    $repository = $this->getDoctrine()
		    ->getRepository('BlogBundle:Entities\Forum');

	    $forum = $repository->findOneById($forumId);
	    $editFlag = TRUE;
	}

	$form = $this->createForm(new ForumForm(), $forum);

	return $this->render('BlogBundle:Blog\Forum:add-edit.html.twig', array(
		    'forumForm' => $form->createView(), 'editFlag' => $editFlag,
		    'categoryId' => $categoryId, 'forumId' => $forumId,
	));
    }

    public function saveAction(Request $request, $categoryId, $forumId) {

	$entityManager = $this->getDoctrine()->getManager();
	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Forum');

	if (is_null($forumId)) {
	    $forum = new Forum();
	    $catRepository = $this->getDoctrine()
		    ->getRepository('BlogBundle:Entities\Category');
	    $category = $catRepository->findOneById($categoryId);
	    if (!$category) {
		throw $this->createNotFoundException(
			'No Category found for id ' . $categoryId
		);
	    }

	    $forum->setCategory($category);
	} else {
	    $forum = $repository->findOneById($forumId);
	    if (!$forum) {
		throw $this->createNotFoundException(
			'No Forum found for id ' . $forumId
		);
	    }
	}

	$submittedForm = $this->createForm(new ForumForm(), $forum);

	$submittedForm->handleRequest($request);

	if ($submittedForm->isValid()) {
	    if (is_null($forumId)) {
		$entityManager->persist($forum);
		$entityManager->flush();
	    } else {
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->flush();
	    }
	}

	return $this->redirectToRoute('view_forum', array(
		    'categoryId' => $categoryId,
			), 301);
    }

    public function removeAction($categoryId, $forumId = NULL) {

	if (!is_null($forumId)) {
	    $entityManager = $this->getDoctrine()->getManager();
	    $repository = $this->getDoctrine()
		    ->getRepository('BlogBundle:Entities\Forum');
	    $forum = $repository->findOneById($forumId);
	    if (!$forum) {
		throw $this->createNotFoundException(
			'No forum found for id ' . $forumId
		);
	    }
	    $entityManager->remove($forum);
	    $entityManager->flush();
	}

	return $this->redirectToRoute('view_forum', array(
		    'categoryId' => $categoryId,
			), 301);
    }

}
