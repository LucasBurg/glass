<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Venda\Model\VendaTotalEntity;

class VendaTotalMapper 
{
    protected $tableName = 'venda_total';
    protected $adapter;
    protected $sql;
    
    public function __construct(Adapter $adapter)
    {
	$this->adapter = $adapter;
	$this->sql     = new Sql($adapter);
	$this->sql->setTable($this->tableName);
    }

    public function save(VendaTotalEntity $entity)
    {
	$classMethods = new ClassMethods();
	$data         = $classMethods->extract($entity);
	
	$select = $this->sql->select();
	$select->where(array('venda_id' => $entity->getVendaId()));
	$stmt   = $this->sql->prepareStatementForSqlObject($select);
	$result = $stmt->execute()->current();
	
	if($result) {
	   $action = $this->sql->update();
	   unset($data['venda_id']);
	   $action->set($data);
	   $action->where(array('venda_id' => $entity->getVendaId()));  
	} else {
	   $action = $this->sql->insert();
	   $action->values($data); 
	}
	
	$stmt2 = $this->sql->prepareStatementForSqlObject($action);
	return $stmt2->execute();
    }
}
