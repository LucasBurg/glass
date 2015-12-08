<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 29/11/2015 11:13:37
 */
namespace Item\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Item\Model\ItemEntity;
use Item\Form\ItemForm;

class ItemController extends AbstractActionController 
{
    public function indexAction()
    {
	$req = $this->getRequest();
	$mapper = $this->getItemMapper();
	
	if($req->isXmlHttpRequest()) {
	    $post = $req->getPost();
	    $validator = new \Zend\I18n\Validator\Alpha();
	    if($validator->isValid($post['query'])) {
		$result = $mapper->fetchLike($post['query']);
		return new \Zend\View\Model\JsonModel(array('data' => $result, 'success' => true));	
	    } 
	    $erros = $validator->getMessages();
	    return new \Zend\View\Model\JsonModel(array('data' => $erros, 'success' => false));
	}
	
	return new ViewModel(array(
	    'itens' => $mapper->fetchAll()
	));
    }
    
    public function addAction()
    {
	$form   = new ItemForm();
	$entity = new ItemEntity();
	$form->bind($entity);
	$req = $this->getRequest();
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getItemMapper()->save($entity);
		return $this->redirect()->toRoute('item');
	    }
	}
	$tipoMapper = $this->getTipoMapper();
	$options    = $tipoMapper->fetchOptionsSelect();
	$form->get('tipo_id')->setValueOptions($options);
	return array('form' => $form);
    }
    
    public function editAction()
    {
	$id = (int) $this->params('id');
	if (!$id) {
	    return $this->redirect()->toRoute('item', array('action' => 'add'));
	}
	$item = $this->getItemMapper()->fetchOne($id);
	$form = new ItemForm();
	$form->bind($item);
	$req = $this->getRequest();
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getItemMapper()->save($item);
		return $this->redirect()->toRoute('item');
	    }
	}
	$tipoMapper = $this->getTipoMapper();
	$options    = $tipoMapper->fetchOptionsSelect();
	$form->get('tipo_id')->setValueOptions($options);
	return array('id' => $id, 'form' => $form);
    }
    
    public function deleteAction()
    {
	$id = (int) $this->params('id');
	if (!$id) {
	    return $this->redirect()->toRoute('item');
	}
	$item = $this->getItemMapper()->fetchOne($id);
	if (!$item) {
	    return $this->redirect()->toRoute('item');
	}
	$req = $this->getRequest();
	if ($req->isPost()) {
	    if ($req->getPost()->get('del') == 'Sim') {
		$this->getItemMapper()->delete($id);
	    }
	    return $this->redirect()->toRoute('item');
	}
	return array('id' => $id, 'item' => $item);
    }
    
    
    public function getItemMapper()
    {
	return $this->getServiceLocator()->get('ItemMapper');
    }
    
    public function getTipoMapper()
    {
	return $this->getServiceLocator()->get('TipoMapper');
    }
    
}


