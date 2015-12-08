<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Venda\Model\VendaItemEntity;

class VendaItemMapper 
{
    protected $tableName = 'item_venda';
    protected $adapter;
    protected $sql;
    
    public function __construct(Adapter $adapter)
    {
	$this->adapter = $adapter;
	$this->sql     = new Sql($adapter);
	$this->sql->setTable($this->tableName);
    }
    
    public function fetchAll()
    {
	$select  = $this->sql->select();
	$stmt    = $this->sql->prepareStatementForSqlObject($select);
	$results = $stmt->execute();
	$entity       = new VendaItemEntity();
	$classMethods = new ClassMethods();
	$resultset    = new HydratingResultSet($classMethods, $entity);
	$resultset->initialize($results);
	return $resultset;
    }
    
    public function fetchOne($id)
    {
	$select = $this->sql->select();
	$select->where(array('id' => $id));
	$stmt   = $this->sql->prepareStatementForSqlObject($select);
	$result = $stmt->execute()->current();
	if (!$result) {
	    return false;
	}
	$classMethods = new ClassMethods();
	$entity       = new VendaItemEntity();
	$classMethods->hydrate($result, $entity);
	return $entity;
    }
    
    public function save(VendaItemEntity $entity)
    {
	$classMethods = new ClassMethods();
	$data = $classMethods->extract($entity);
	$action = $this->sql->insert();
	$action->values($data);
	$stmt = $this->sql->prepareStatementForSqlObject($action);
	$result = $stmt->execute();
	return (bool) $result->getAffectedRows();
    }
}

