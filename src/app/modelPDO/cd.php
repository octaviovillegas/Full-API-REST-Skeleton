<?php
namespace App\Models\PDO;
use App\Models\PDO\AccesoDatos;
include_once __DIR__ . '/AccesoDatos.php';

class cd
{
	public $id;
 	public $titulo;
  	public $cantante;
  	public $año;

  	public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as titulo, interpret as cantante,jahr as año from cds");
			$consulta->execute();			
			return $consulta->fetchAll(\PDO::FETCH_CLASS, "App\Models\PDO\cd");		
	}

}