<?php
namespace Venda\Controller;


use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\JsonModel;

use Venda\Model\VendaItemEntity;
use Venda\Form\VendaItemForm;



class VendaItemController extends AbstractActionController 
{
    public function indexAction()
    {
	if (!$this->getRequest()->isXmlHttpRequest()) {
	    return $this->redirect()->toRoute('venda'); 
	}
	
	$entity = new VendaItemEntity();
	$form   = new VendaItemForm();
	$form->bind($entity);
	
	$post = $this->getRequest()->getPost();
	$form->setData($post);
	
	if ($form->isValid()) {
	    $service    = $this->getCalculoService();
	    $venda_id   = $form->get('venda_id')->getValue();
	    $item_id    = $form->get('item_id')->getValue();
	    $quantidade = $form->get('quantidade')->getValue();
	    $result     = $service->calcule($item_id, $quantidade);
	    
	    if ($result) {
		$data = $result->current();
		$entity->setImposto($data['imposto']);
		$entity->setTotal($data['total']);
		$service = $this->getVendaItemMapper();
		$result  = $service->save($entity);
		
		if ($result) {
		    $vendas = $this->getVendaMapper()->fetchVendaItem($venda_id)->toArray();
		}
	    }
	}
	return new JsonModel($vendas);
    }
    
    public function getCalculoService()
    {
	return $this->getServiceLocator()->get('CalculoService');
    }
    
    public function getVendaItemMapper()
    {
	return $this->getServiceLocator()->get('VendaItemMapper');
    }
    
    public function getVendaMapper()
    {
	return $this->getServiceLocator()->get('VendaMapper');
    }
}


