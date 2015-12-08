<?php
namespace Venda\Service;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class CalculoService 
{
    protected $adapter;


    public function __construct($adapter)
    {
	$this->adapter = $adapter;
    }
    
    public function calcule($item_id, $quantidade)
    {
	$sql = "select 
		    (it.preco * ?) as total, 
		    (((it.preco / 100) * im.percentual) * ?) as imposto
		from imposto as im
		inner join tipo as ti
		on im.id = ti.imposto_id
		inner join item it 
		on ti.id = it.tipo_id
		where it.id = ?
		order by ti.id";
	$stmt = $this->adapter->createStatement($sql, array($quantidade, $quantidade, $item_id));
	$stmt->prepare();
	$result = $stmt->execute();
	if ($result instanceof ResultInterface && $result->isQueryResult()) {
	    $resultSet = new ResultSet();
	    $resultSet->initialize($result);
	    return $resultSet;
	}
	return false;
    }
    
}
