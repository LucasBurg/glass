<?php
namespace Venda\Service;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class TotalizaVendaService 
{
    protected $adapter;


    public function __construct($adapter)
    {
	$this->adapter = $adapter;
    }
    
    public function fetchTotalizaByVenda($id)
    {
	$sql = "select iv.venda_id as venda_id,
		    sum(iv.total) as total,
		    sum(iv.imposto) as imposto
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
	if ($result instanceof ResultInterface && $result->isQueryResult()) {
	    $resultSet = new ResultSet();
	    $resultSet->initialize($result);
	    return $resultSet;
	}
	return false;
    }
}
