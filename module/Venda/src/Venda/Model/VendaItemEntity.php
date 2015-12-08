<?php
/**
 * @author Lucas Mota
 */
namespace Venda\Model;

class VendaItemEntity 
{
    protected $venda_id;
    
    protected $item_id;
    
    protected $quantidade;
    
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
    
    public function getItemId()
    {
	return $this->item_id;
    }
    
    public function setItemId($value)
    {
	$this->item_id = $value;
    }
    
    public function getQuantidade()
    {
	return $this->quantidade;
    }
    
    public function setQuantidade($value)
    {
	$this->quantidade = $value;
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