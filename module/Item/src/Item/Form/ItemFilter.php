<?php
/**
 * @author Lucas Mota
 */
namespace Item\Form;

use Zend\InputFilter\InputFilter;

class ItemFilter extends InputFilter
{
    public function __construct()
    {
	$this->add(array(
	    'name'     => 'id',
	    'required' => false,
	    'filters'  => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
	
	$this->add(array(
	    'name'     => 'tipo_id',
	    'required' => true,
	    'filters'  => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
	
	$this->add(array(
	    'name' => 'nome',
	    'required' => true,
	    'filters' => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
	
	$this->add(array(
	    'name' => 'preco',
	    'required' => true,
	    'filters' => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
    }
}
