<?php
/**
 * @author Lucas Mota
 */
namespace Item\Model;

class ItemEntity 
{
    protected $id;
    protected $tipo_id;
    protected $nome;
    protected $preco;
    
    public function getId()
    {
	return $this->id;
    }
    
    public function setId($value)
    {
	$this->id = $value;
    }
    
    public function getTipoId()
    {
	return $this->tipo_id;
    }
    
    public function setTipoId($value)
    {
	$this->tipo_id = $value;
    }
    
    public function getNome()
    {
	return $this->nome;
    }
    
    public function setNome($value)
    {
	$this->nome = $value;
    }
    
    public function getPreco()
    {
	return $this->preco;
    }
    
    public function setPreco($value)
    {
	$this->preco = $value;
    }
}
