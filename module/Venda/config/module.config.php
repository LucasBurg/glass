<?php
/**
 * @author Lucas Mota
 */

namespace Venda;

return array(
    'controllers' => array(
        'invokables' => array(
            'venda' => 'Venda\Controller\VendaController',
	    'vendaItem' => 'Venda\Controller\VendaItemController'
        )
    ),
    'router' => array(
        'routes' => array(
            'venda' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/venda[/:action[/:id]]',
		    'defaults' => array(
                        'controller' => 'venda',
                        'action'     => 'index',
                    ),
		    'constraints' => array(
			'action' => '(do|item|total)',
			'id'     => '[0-9]+'
		    )
                )
	    ),
	    'venda-item' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/venda-item',
		    'defaults' => array(
                        'controller' => 'vendaItem',
                        'action'     => 'index',
                    )
		)
	    )
	)
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
	'strategies' => array(
	    'ViewJsonStrategy'
	)
    )
);
