<?php
/**
 * @author Lucas Mota
 */
namespace Imposto\Model;

class ImpostoEntity 
{
    protected $id;
    protected $nome;
    protected $percentual;
    protected $descricao;
    
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
    
    public function getPercentual()
    {
	return $this->percentual;
    }
    
    public function setPercentual($value)
    {
	$this->percentual = $value;
    }
    
    public function getDescricao()
    {
	return $this->descricao;
    }
    
    public function setDescricao($value)
    {
	$this->descricao = $value;
    }
}

