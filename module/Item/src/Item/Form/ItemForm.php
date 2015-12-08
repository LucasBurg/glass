<?php
/**
 * @author Lucas Mota
 */
namespace Item\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Item\Form\ItemFilter;

class ItemForm extends Form 
{
    public function __construct()
    {
	parent::__construct('item');
	
	$this->setInputFilter(new ItemFilter());
	$this->setHydrator(new ClassMethods());
	
	$this->add(array(
	    'name' => 'id',
	    'type' => 'hidden'
	));
	
	$this->add(array(
	    'name' => 'nome',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Nome'
	    ),
	    'attributes' => array(
		'class' => 'form-control'
	    )
	));
	
	$this->add(array(
	    'name' => 'preco',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Preço'
	    ),
	    'attributes' => array(
		'class' => 'form-control'
	    )
	));
	
	$this->add(array(
	    'name' => 'tipo_id',
	    'type' => 'select',
	    'options' => array(
		'label' => 'Tipo',
		'empty_option' => '---',
		'disable_inarray_validator' => true
	    ),
	    'attributes' => array(
		'class' => 'form-control'
	    )
	));
	
	$this->add(array(
	    'name' => 'submit',
	    'type' => 'submit',
	    'attributes' => array(
		'value' => 'Salvar',
		'id'    => 'btnSubmit',
		'class' => 'btn btn-default'
	    )
	));
    }
}

