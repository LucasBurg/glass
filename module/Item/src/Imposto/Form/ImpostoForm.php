<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 27/11/2015 21:56:49
 */
namespace Imposto\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Imposto\Form\ImpostoFilter;

class ImpostoForm extends Form
{
    public function __construct()
    {
	parent::__construct('imposto');
	
	$this->setInputFilter(new ImpostoFilter());
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
	    'name' => 'percentual',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Percentual'
	    ),
	    'attributes' => array(
		'class' => 'form-control'
	    )
	));
	
	$this->add(array(
	    'name' => 'descricao',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Descrição'
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

