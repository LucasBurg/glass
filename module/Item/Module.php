<?php
/**
 * @author Lucas Mota
 * @since 24/11/2015 21:24
 */
namespace Item;

use Imposto\Model\ImpostoMapper;
use Tipo\Model\TipoMapper;
use Item\Model\ItemMapper;

class Module
{
    public function getServiceConfig() 
    {
	return array(
	    'factories' => array(
		'ImpostoMapper' => function ($sm) {
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new ImpostoMapper($adapter);
		},
		'TipoMapper' => function ($sm) {
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new TipoMapper($adapter);
		},
		'ItemMapper' => function ($sm) {
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new ItemMapper($adapter);
		}
	    )
	);
    }

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
	return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    'Imposto'     => __DIR__.'/src/Imposto',
		    'Tipo'        => __DIR__.'/src/Tipo',
		    'Item'        => __DIR__.'/src/Item'
                )
            )
        );
    }
}

