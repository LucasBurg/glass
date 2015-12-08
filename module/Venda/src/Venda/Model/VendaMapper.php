<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Venda\Model\VendaEntity;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class VendaMapper 
{
    protected $tableName = 'venda';
    protected $adapter;
    protected $sql;
    
    public function __construct(Adapter $adapter)
    {
	$this->adapter = $adapter;
	$this->sql     = new Sql($adapter);
	$this->sql->setTable($this->tableName);
    }
    
    public function fetchVendaItem($id)
    {
	$sql = "select it.nome, 
		    iv.quantidade,
		    iv.total,
		    iv.imposto
		from item_venda as iv
		inner join item it
		on it.id = iv.item_id
		inner join tipo ti
		on it.tipo_id = ti.id
		inner join imposto im
		on ti.imposto_id = im.id
		where iv.venda_id = ?";
	$stmt = $this->adapter->createStatement($sql, array($id));
	$stmt->prepare();
	$result = $stmt->execute();
	if ($result instanceof ResultInterface) {
	    $resultSet = new ResultSet();
	    $resultSet->initialize($result);
	    return $resultSet;
	}
	return false;
    }
    
    public function fetchVendaTotal($id)
    {
	$sql = "select vt.total, 
		vt.imposto 
		from venda_total as vt 
		where vt.venda_id = ?";
	$stmt = $this->adapter->createStatement($sql, array($id));
	$stmt->prepare();
	$result = $stmt->execute();
	if ($result instanceof ResultInterface) {
	    $resultSet = new ResultSet();
	    $resultSet->initialize($result);
	    return $resultSet;
	}
	return false;
    }
    
    
    public function fetchItemLike($query)
    {
	$like = '%'.str_replace(' ', '%', $query).'%';
	$sql = new Sql($this->adapter);
	$select = $sql->select();
	
	$select->from(array('im' => 'imposto'))->columns(array('percentual'))
	->join(array('ti' => 'tipo'), 'im.id = ti.imposto_id', array())
	->join(array('it' => 'item'), 'ti.id = it.tipo_id', array('id', 'nome', 'preco'))
	->where->like('it.nome', $like);
	
	$stmt    = $sql->prepareStatementForSqlObject($select);
	$result  = $stmt->execute();
	
	if (!$result) {
	    return false;
	}
	
	return $result;
    }


    public function fetchAll()
    {
	$select  = $this->sql->select();
	$stmt    = $this->sql->prepareStatementForSqlObject($select);
	$results = $stmt->execute();
	$entity       = new VendaEntity();
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
	$entity       = new VendaEntity();
	$classMethods->hydrate($result, $entity);
	return $entity;
    }
    
    public function save(VendaEntity $entity)
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
