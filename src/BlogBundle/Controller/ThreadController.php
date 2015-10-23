<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Controller;

use BlogBundle\Entity\Entities\Reply;
use BlogBundle\Entity\Entities\Thread;
use BlogBundle\Form\ThreadForm;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ThreadController
 *
 * @author kimo
 */
class ThreadController extends Controller {

    //put your code here

    public function viewAction($forumId = NULL) {

	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Thread');

	if ($forumId == NULL) {

	    $threadList = $repository->findAll();
	} else {

	    $threadList = $repository->findByForum($forumId);
	}

	return $this->render('BlogBundle:Blog\Thread:view.html.twig', array(
		    'threadList' => $threadList, 'forumId' => $forumId,
	));
    }

    public function addAction(Request $request, $forumId = NULL) {

	$thread = new Thread();

	$thread->setUser($this->getUser());
	$thread->setCreateTime(new DateTime('now'));

	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Forum');

	$thread->setForum($repository->findOneById($forumId));

	$form = $this->createForm(new ThreadForm(), $thread);

	$form->handleRequest($request);

	if ($form->isValid()) {

	    $entityManager = $this->getDoctrine()->getManager();
	    $entityManager->persist($thread);
	    $entityManager->flush();

	    return $this->redirectToRoute('view_forum_threads', array(
			'forumId' => $forumId,
			    ), 301);
	} else {

	    return $this->render('BlogBundle:Blog\Thread:add-edit.html.twig', array('threadForm' => $form->createView()
			, 'editFlag' => FALSE, 'forumId' => $forumId));
	}
    }

    public function editAction(Request $request, $forumId, $threadId) {



	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Thread');

	$thread = $repository->findOneById($threadId);

	$form = $this->createForm(new ThreadForm(), $thread);

	$form->handleRequest($request);

	if ($form->isValid()) {

	    foreach ($thread->getRepliesList() as $reply) {
		$reply->setUser($this->getUser());
	    }

	    $entityManager = $this->getDoctrine()->getManager();
	    $entityManager->persist($thread);
	    $entityManager->flush();

	    return $this->redirectToRoute('view_forum_threads', array(
			'forumId' => $forumId,
			    ), 301);
	} else {

	    return $this->render('BlogBundle:Blog\Thread:add-edit.html.twig'
			    , array('threadForm' => $form->createView(), 'editFlag' => TRUE
			, 'forumId' => $forumId, 'threadId' => $threadId));
	}
    }

}
