<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 */
namespace Venda\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Venda\Form\VendaForm;
use Venda\Form\VendaItemForm;
use Venda\Model\VendaEntity;
use Venda\Model\VendaItemEntity;
use Venda\Model\VendaTotalEntity;

class VendaController extends AbstractActionController
{
    public function indexAction()
    {
	$form = new VendaForm();
	$mapper = $this->getVendaMapper();
	return array('form' => $form, 'vendas' => $mapper->fetchAll());
    }
    
    public function totalAction()
    {
	if(!$this->getRequest()->isXmlHttpRequest()) { 
	    $this->getResponse()->setStatusCode(401);
	    return false;
	}
	
	$post      = $this->getRequest()->getPost();
	$validator = new \Zend\I18n\Validator\IsInt();
	
	if ($validator->isValid($post['venda_id'])) {
	    $service = $this->getServiceLocator()->get('TotalizaVendaService');
	    $result  = $service->fetchTotalizaByVenda($post['venda_id'])->toArray();
	    
	    if (!empty($result)) {
		$entity = new VendaTotalEntity();
		$entity->setVendaId($result[0]['venda_id']);
		$entity->setTotal($result[0]['total']);
		$entity->setImposto($result[0]['imposto']);
		$service = $this->getServiceLocator()->get('VendaTotalMapper');    
		$service->save($entity);
		return new \Zend\View\Model\JsonModel($result[0]);
	    }
	}
	$this->getResponse()->setStatusCode(401);
	return false;
	
    }
    
    public function doAction()
    {
	$id = $this->params('id');
	$req = $this->getRequest();
	
	if (!$req->isPost() && !$id) {
	   return $this->redirect()->toRoute('venda'); 
	}
	
	if ($req->isPost() && !$id) {
	    $entity = new VendaEntity();
	    $venda = $this->getVendaMapper()->save($entity);
	    if ($venda->valid()) {
		$id = $venda->getGeneratedValue();
		return $this->redirect()->toRoute(null, array('action' => 'do', 'id' => $id));
	    }
	    throw new \Exception('A entity não é válida!'); 
	}
	
	$venda = $this->getVendaMapper()->fetchOne($id);
	
	if (!$venda) {
	   return $this->redirect()->toRoute('venda');   
	}
	
	$entity = new VendaItemEntity();
	$form = new VendaItemForm();
	$form->bind($entity);
	$form->get('venda_id')->setValue($venda->getId());
	
	$itens = $this->getVendaMapper()->fetchVendaItem($venda->getId());
	
	$total = $this->getVendaMapper()->fetchVendaTotal($venda->getId())->toArray();
	
	if(isset($total[0])) {
	    $total = $total[0];
	} else {
	    $total['imposto'] = '';
	    $total['total']   = '';
	}
	
	return array('venda' => $venda, 'form' => $form, 'id' => $id, 'itens' => $itens, 'total' => $total);
    }
    
    public function itemAction()
    {
	if($this->getRequest()->isXmlHttpRequest()) {
	    $mapper = $this->getVendaMapper();
	    $post   = $this->getRequest()->getPost();
	    $validator = new \Zend\I18n\Validator\Alpha(array('allowWhiteSpace' => true));
	    if($validator->isValid($post['query'])) {
		$result = $mapper->fetchItemLike($post['query']);
		if (!$result->count()) {
		    $this->getResponse()->setStatusCode(404);
		    return new \Zend\View\Model\JsonModel($result);	
		}
		return new \Zend\View\Model\JsonModel($result);	
	    } 
	    $erros = $validator->getMessages();
	    $this->getResponse()->setStatusCode(401);
	    return new \Zend\View\Model\JsonModel($erros);
	}
	$this->getResponse()->setStatusCode(401);
	return false;
    }
    
    public function getVendaMapper()
    {
	return $this->getServiceLocator()->get('VendaMapper');
    }
}
