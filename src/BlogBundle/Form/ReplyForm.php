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
 * Description of ReplyForm
 *
 * @author kimo
 */
class ReplyForm extends AbstractType {

//put your code here

    public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder->add('body', 'textarea', array('label' => 'Reply'));
    }

    public function configureOptions(OptionsResolver $resolver) {
	$resolver->setDefaults(array('data_class' => 'BlogBundle\Entity\Entities\Reply'));
    }

    public function getName() {
	return 'blog_reply_form';
    }

}
