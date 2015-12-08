<?php
/**
 * @author Lucas Mota
 */
namespace Tipo\Model;

class TipoEntity 
{
    protected $id;
    protected $nome;
    protected $imposto_id;
    
    public function getId()
    {
	return $this->id;
    }
    
    public function setId($value)
    {
	$this->id = $value;
    }
    
    public function getNome()
    {
	return $this->nome;
    }
    
    public function setNome($value) 
    {
	$this->nome = $value;
    }
    
    public function getImpostoId()
    {
	return $this->imposto_id;
    }
    
    public function setImpostoId($value)
    {
	$this->imposto_id = $value;
    }
}
