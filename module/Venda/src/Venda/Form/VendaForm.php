<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class VendaForm extends Form
{
    public function __construct()
    {
	parent::__construct('venda');
	
	$this->setHydrator(new ClassMethods());
	
	$this->add(array(
	    'name' => 'id',
	    'type' => 'hidden'
	));
	
	$this->add(array(
	    'name' => 'submit',
	    'type' => 'submit',
	    'attributes' => array(
		'value' => 'Nova venda',
		'id'    => 'btnSubmit',
		'class' => 'btn btn-primary'
	    )
	));
    }
}