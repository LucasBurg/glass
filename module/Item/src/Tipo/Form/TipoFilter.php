<?php
/**
 * @author Lucas Mota
 */
namespace Tipo\Form;

use Zend\InputFilter\InputFilter;

class TipoFilter extends InputFilter
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
	    'name' => 'nome',
	    'required' => true,
	    'filters' => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
	
	$this->add(array(
	    'name'     => 'imposto_id',
	    'required' => true,
	    'filters'  => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
    }
}
