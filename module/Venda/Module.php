<?php
/**
 * @author Lucas Mota
 */
namespace Venda;

use Venda\Model\VendaMapper;
use Venda\Service\CalculoService;
use Venda\Model\VendaItemMapper;
use Venda\Service\TotalizaVendaService;
use Venda\Model\VendaTotalMapper;

class Module
{
    public function getServiceConfig() 
    {
	return array(
	    'factories' => array(
		'VendaMapper' => function ($sm) {
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new VendaMapper($adapter);
		},
		'CalculoService' => function($sm){
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new CalculoService($adapter);
		},
		'VendaItemMapper' => function($sm){
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new VendaItemMapper($adapter);
		},
		'TotalizaVendaService' => function($sm){
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new TotalizaVendaService($adapter);
		},
		'VendaTotalMapper' => function($sm){
		    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
		    return new VendaTotalMapper($adapter);
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
		    'Venda' => __DIR__.'/src/Venda',
		)
            )
        );
    }
}

