<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ThreadForm
 *
 * @author kimo
 */
class ThreadForm extends AbstractType {

//put your code here

    public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder->add('title', 'text', array('label' => 'Title',));

	$builder->add('body', 'textarea', array('label' => 'Body',));

	$builder->add('sticky', 'checkbox', array('label' => 'Sticky',));

	$builder->add('closed', 'checkbox', array('label' => 'Closed',));

	$builder->add('repliesList', 'collection', array('label' => FALSE,
	    'type' => new ReplyForm(),
	    'allow_add' => TRUE,
	    'allow_delete' => true,
	    'by_reference' => false,));

	$builder->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName() {
	return 'blog_thread_form';
    }

    public function configureOptions(OptionsResolver $resolver) {
	$resolver->setDefaults(array('data_class' => 'BlogBundle\Entity\Entities\Thread'));
    }

}
