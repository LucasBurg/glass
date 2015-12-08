<?php
/**
 * @author Lucas Daniel Burg Mota <lucasburgmota@gmail.com>
 * @since 29/11/2015 11:13:37
 */
namespace Tipo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tipo\Model\TipoEntity;
use Tipo\Form\TipoForm;

class TipoController extends AbstractActionController 
{
    public function indexAction()
    {
	$mapper = $this->getTipoMapper();
	return new ViewModel(array(
	    'tipos' => $mapper->fetchAll()
	));
    }
    
    public function addAction()
    {
	$form   = new TipoForm();
	$entity = new TipoEntity();
	$form->bind($entity);
	$req = $this->getRequest();
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getTipoMapper()->save($entity);
		return $this->redirect()->toRoute('tipo');
	    }
	}
	$mapper   = $this->getImpostoMapper();
	$impostos = $mapper->fetchOptionsSelect();
	$imposto_id = $form->get('imposto_id');
	$imposto_id->setValueOptions($impostos);
	return array('form' => $form);
    }
    
    public function editAction()
    {
	$id = (int) $this->params('id');
	if (!$id) {
	    return $this->redirect()->toRoute('tipo', array('action' => 'add'));
	}
	$tipo = $this->getTipoMapper()->fetchOne($id);
	$form = new TipoForm();
	$form->bind($tipo);
	$req = $this->getRequest();
	if ($req->isPost()) {
	    $form->setData($req->getPost());
	    if ($form->isValid()) {
		$this->getTipoMapper()->save($tipo);
		return $this->redirect()->toRoute('tipo');
	    }
	}
	$mapper   = $this->getImpostoMapper();
	$impostos = $mapper->fetchOptionsSelect();
	$imposto_id = $form->get('imposto_id');
	$imposto_id->setValueOptions($impostos);
	return array('id' => $id, 'form' => $form);
    }
    
    public function deleteAction()
    {
	$id = (int) $this->params('id');
	if (!$id) {
	    return $this->redirect()->toRoute('tipo');
	}
	$tipo = $this->getTipoMapper()->fetchOne($id);
	if (!$tipo) {
	    return $this->redirect()->toRoute('tipo');
	}
	
	$req = $this->getRequest();
	
	if ($req->isPost()) {
	    if ($req->getPost()->get('del') == 'Sim') {
		$this->getTipoMapper()->delete($id);
	    }
	    return $this->redirect()->toRoute('tipo');
	}
	return array('id' => $id, 'tipo' => $tipo);
    }
    
    
    public function getTipoMapper()
    {
	return $this->getServiceLocator()->get('TipoMapper');
    }
    
    public function getImpostoMapper()
    {
	return $this->getServiceLocator()->get('ImpostoMapper');
    }
}


