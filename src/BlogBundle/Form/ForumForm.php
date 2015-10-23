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
 * Description of AreaForm
 *
 * @author kimo
 */
class ForumForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder->add('name', 'text', array('label' => 'Name',));
	$builder->add('description', 'textarea', array('label' => 'Description',));
	$builder->add('closed', 'checkbox', array('label' => 'Is Closed',));

	$builder->add('submit', 'submit', array('label' => 'save',));
    }

    public function configureOptions(OptionsResolver $resolver) {
	$resolver->setDefaults(array('data_class' => 'BlogBundle\Entity\Entities\Forum'));
    }

    public function getName() {
	return 'blog_category_form';
    }

}
