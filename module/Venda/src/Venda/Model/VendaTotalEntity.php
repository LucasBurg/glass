<?php
namespace Venda\Model;

class VendaTotalEntity 
{
    protected $venda_id;
    
    protected $total;
    
    protected $imposto;
    
    public function getVendaId()
    {
	return $this->venda_id;
    }
    
    public function setVendaId($value)
    {
	$this->venda_id = $value;
    }
    
    public function getTotal()
    {
	return $this->total;
    }
    
    public function setTotal($value)
    {
	$this->total = $value;
    }
    
    public function getImposto()
    {
	return $this->imposto;
    }
    
    public function setImposto($value)
    {
	$this->imposto = $value;
    }
}
