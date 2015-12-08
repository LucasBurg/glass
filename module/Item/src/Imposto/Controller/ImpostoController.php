<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 27/11/2015 20:55:33
 */
namespace Imposto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Imposto\Model\ImpostoEntity;
use Imposto\Form\ImpostoForm;

class ImpostoController extends AbstractActionController
{
    public function indexAction()
    {
	$mapper = $this->getImpostoMapper();
	return new ViewModel(array(
	    'impostos' => $mapper->fetchAll()
	));
    }
    
    public function addAction()
    {
	$form   = new ImpostoForm();
	$entity = new ImpostoEntity();
	
	$form->bind($entity);
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getImpostoMapper()->save($entity);
		return $this->redirect()->toRoute('imposto');
	    }
	}
	return array('form' => $form);
    }
    
    public function editAction()
    {
	$id = (int) $this->params('id');
	
	if (!$id) {
	    return $this->redirect()->toRoute('imposto', array('action' => 'add'));
	}
	
	$imposto = $this->getImpostoMapper()->fetchOne($id);
	
	
	$form = new ImpostoForm();
	$form->bind($imposto);
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getImpostoMapper()->save($imposto);
		return $this->redirect()->toRoute('imposto');
	    }
	}
	
	return array('id' => $id, 'form' => $form);
    }
    
    public function deleteAction()
    {
	$id = (int) $this->params('id');
	
	if (!$id) {
	    return $this->redirect()->toRoute('imposto');
	}
	
	$imposto = $this->getImpostoMapper()->fetchOne($id);
	
	if (!$imposto) {
	    return $this->redirect()->toRoute('imposto');
	}
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    if ($req->getPost()->get('del') == 'Sim') {
		$this->getImpostoMapper()->delete($id);
	    }
	    
	    return $this->redirect()->toRoute('imposto');
	}
	
	
	return array('id' => $id, 'imposto' => $imposto);
    }
    
    public function getImpostoMapper()
    {
	return $this->getServiceLocator()->get('ImpostoMapper');
    }
    
}


