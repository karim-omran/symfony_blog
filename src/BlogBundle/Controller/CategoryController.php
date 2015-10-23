<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Entities\Category;
use BlogBundle\Entity\Entities\Document;
use BlogBundle\Form\CategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {

    public function viewAction($categoryId = NULL) {

	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Category');

	if ($categoryId == NULL) {

	    $categoryList = $repository->findAll();
	} else {

	    $categoryList = $repository->findOneById($categoryId);
	}

	return $this->render('BlogBundle:Blog\Category:view.html.twig', array(
		    'categoryList' => $categoryList,
	));
    }

    public function addEditAction($categoryId = NULL) {

	if ($categoryId == NULL) {

	    $category = new Category();
	    $editFlag = FALSE;
	} else {

	    $repository = $this->getDoctrine()
		    ->getRepository('BlogBundle:Entities\Category');

	    $category = $repository->findOneById($categoryId);
	    $editFlag = TRUE;
	}

	$form = $this->createForm(new CategoryForm(), $category);

	return $this->render('BlogBundle:Blog\Category:add-edit.html.twig', array(
		    'catForm' => $form->createView(), 'editFlag' => $editFlag, 'categoryId' => $categoryId,
	));
    }

    public function saveAction(Request $request, $categoryId) {

	$category = NULL;

	$entityManager = $this->getDoctrine()->getManager();
	$repository = $this->getDoctrine()
		->getRepository('BlogBundle:Entities\Category');

	if (is_null($categoryId)) {
	    $category = new Category();
	} else {
	    $category = $repository->findOneById($categoryId);
	    if (!$category) {
		throw $this->createNotFoundException(
			'No Category found for id ' . $categoryId
		);
	    }
	}

	$submittedForm = $this->createForm(new CategoryForm(), $category);

	$submittedForm->handleRequest($request);

	if ($submittedForm->isValid()) {
	    if (is_null($categoryId)) {
		$entityManager->persist($category);
		$entityManager->flush();
	    } else {
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->flush();
	    }
	}

	return $this->redirectToRoute('homepage', array(), 301);
    }

    public function removeAction($categoryId = NULL) {

	if (!is_null($categoryId)) {
	    $entityManager = $this->getDoctrine()->getManager();
	    $repository = $this->getDoctrine()
		    ->getRepository('BlogBundle:Entities\Category');
	    $category = $repository->findOneById($categoryId);
	    if (!$category) {
		throw $this->createNotFoundException(
			'No Category found for id ' . $categoryId
		);
	    }
	    $entityManager->remove($category);
	    $entityManager->flush();
	}

	return $this->redirectToRoute('homepage', array(), 301);
    }

}
