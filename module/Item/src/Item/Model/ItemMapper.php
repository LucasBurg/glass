<?php
/**
 * @author Lucas Mota
 */

namespace Item\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Item\Model\ItemEntity;


class ItemMapper 
{
    protected $tableName = 'item';
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
	$entity       = new ItemEntity();
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
	$entity       = new ItemEntity();
	$classMethods->hydrate($result, $entity);
	return $entity;
    }
    
    public function fetchLike($query)
    {
	$q = '%'.str_replace(' ', '%', $query).'%';
	
	
	
	$select = $this->sql->select();
	
	$select->where->like('nome', $q);
	
	
	$stmt   = $this->sql->prepareStatementForSqlObject($select);
	
	$result = $stmt->execute()->current();
	
	if (!$result) {
	    return false;
	}
	
	
	return $result;
	
    }
    
    public function save(ItemEntity $entity)
    {
	$classMethods = new ClassMethods();
	$data         = $classMethods->extract($entity);
	if ($entity->getId()) {
	    $action = $this->sql->update();
	    $action->set($data);
	    $action->where(array('id' => $entity->getId()));
	} else {
	    $action = $this->sql->insert();
	    unset($data['id']);
	    $action->values($data);
	}
	$stmt   = $this->sql->prepareStatementForSqlObject($action);
	$result = $stmt->execute();
	if (!$entity->getId()) {
	    $entity->setId($result->getGeneratedValue());
	}
	return $result;
    }
    
    public function delete($id)
    {
	$delete = $this->sql->delete();
	$delete->where(array('id' => $id));
	$stmt = $this->sql->prepareStatementForSqlObject($delete);
	return $stmt->execute();
    }
}
