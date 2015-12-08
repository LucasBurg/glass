<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 27/11/2015 21:59:02
 */
namespace Imposto\Form;

use Zend\InputFilter\InputFilter;

class ImpostoFilter extends InputFilter
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
	    'name'     => 'percentual',
	    'required' => true,
	    'filters'  => array(
		//array('name' => 'Int')
	    ),
	    'validators' => array(
		array(
		    'name' => 'Regex',
		    'options' => array(
			'pattern' => '/[0-9]+/'
		    )
		)
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
	    'name' => 'descricao',
	    'required' => false,
	    'filters' => array(
		array('name' => 'StripTags'),
		array('name' => 'StringTrim')
	    )
	));
    }    
}