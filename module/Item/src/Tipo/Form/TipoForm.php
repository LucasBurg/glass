<?php
/**
 * @author Lucas Mota
 */
namespace Tipo\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Tipo\Form\TipoFilter;

class TipoForm extends Form 
{
    public function __construct()
    {
	parent::__construct('tipo');
	
	$this->setInputFilter(new TipoFilter());
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
	    'name' => 'imposto_id',
	    'type' => 'select',
	    'options' => array(
		'label' => 'Imposto',
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
