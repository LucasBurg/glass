<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class VendaItemForm extends Form
{
    public function __construct()
    {
	parent::__construct('vendaItem');
	
	$this->setHydrator(new ClassMethods());
	
	$this->add(array(
	    'name' => 'item_id',
	    'type' => 'hidden',
	    'attributes' => array(
		'id' => 'item_id',
	    )
	));
	
	$this->add(array(
	    'name' => 'venda_id',
	    'type' => 'hidden',
	    'attributes' => array(
		'id' => 'venda_id',
	    )
	));
	
	$this->add(array(
	    'name' => 'item_nome',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Nome'
	    ),
	    'attributes' => array(
		'class' => 'form-control typeahead',
		'id'    => 'item_nome' 
	    )
	));
	
	$this->add(array(
	    'name' => 'quantidade',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Quantidade'
	    ),
	    'attributes' => array(
		'class' => 'form-control',
		'id' => 'quantidade'
	    )
	));
	
	$this->add(array(
	    'name' => 'total',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Total'
	    ),
	    'attributes' => array(
		'class' => 'form-control',
		'id' => 'total'
	    )
	));
	
	$this->add(array(
	    'name' => 'imposto',
	    'type' => 'text',
	    'options' => array(
		'label' => 'Imposto'
	    ),
	    'attributes' => array(
		'class' => 'form-control',
		'id' => 'imposto'
	    )
	));
	
	$this->add(array(
	    'name' => 'btn_add_item',
	    'type' => 'button',
	    'options' => array(
		'label' => 'Adicionar'
	    ),
	    'attributes' => array(
		'class' => 'btn btn-success',
		'id' => 'btn_add_item'
	    )
	));
    }
}
