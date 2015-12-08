<?php
namespace Venda\Model;

class VendaEntity 
{
    protected $id;
    protected $data_confirmacao;
    
    public function __construct()
    {
	$this->data_confirmacao = date('Y-m-d H:i:s');
    }
    
    public function getId()
    {
	return $this->id;
    }
    
    public function setId($value)
    {
	$this->id = $value;
    }
    
    public function getDataConfirmacao()
    {
	return $this->data_confirmacao; 
    }
    
    public function setDataConfirmacao($value)
    {
	$this->data_confirmacao = $value;
    }
}
