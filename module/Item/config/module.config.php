<?php
/**
 * @author Lucas Mota
 */

namespace Item;

return array(
    'controllers' => array(
        'invokables' => array(
            'Imposto\Controller\Imposto' => 'Imposto\Controller\ImpostoController',
	    'Tipo\Controller\Tipo'       => 'Tipo\Controller\TipoController',
	    'Item\Controller\Item'       => 'Item\Controller\ItemController'
        )
    ),
    'router' => array(
        'routes' => array(
            'imposto' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/imposto[/:action[/:id]]',
		    'defaults' => array(
                        'controller' => 'Imposto\Controller\Imposto',
                        'action'     => 'index',
                    ),
		    'constraints' => array(
			'action' => '(add|edit|delete)',
			'id'     => '[0-9]+'
		    )
                )
	    ),
	    'tipo' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/tipo[/:action[/:id]]',
		    'defaults' => array(
                        'controller' => 'Tipo\Controller\Tipo',
                        'action'     => 'index',
                    ),
		    'constraints' => array(
			'action' => '(add|edit|delete)',
			'id'     => '[0-9]+'
		    )
                )
	    ),
	    'item' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/item[/:action[/:id]]',
		    'defaults' => array(
                        'controller' => 'Item\Controller\Item',
                        'action'     => 'index',
                    ),
		    'constraints' => array(
			'action' => '(add|edit|delete)',
			'id'     => '[0-9]+'
		    )
                )
	    )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        )
    ),
    'service_manager' => array(
	'factories' => array(
	    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
	)
    ),
    'navigation' => array(
	'default' => array(
	    array(
		'label' => 'Venda',
		'route' => 'venda',
	    ),
	    array(
		'label' => 'Item',
		'route' => 'item',
	    ),
	    array(
		'label' => 'Tipo',
		'route' => 'tipo',
	    ),
	    array(
		'label' => 'Imposto',
		'route' => 'imposto',
	    )
	)
    )
);
