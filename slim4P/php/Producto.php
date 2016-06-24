<?php
require_once"accesoDatos.php";
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $porcentaje;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	/*public function GetId()
	{
		return $this->id;
	}
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDni()
	{
		return $this->dni;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetDni($valor)
	{
		$this->dni = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}*/
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Producto::TraerUnaProducto($id);
			$this->nombre = $obj->nombre;
			$this->edad = $obj->porcentaje;
		}
	}
//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaProducto($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from misproductos where id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaProducto(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$productoBuscada= $consulta->fetchObject('producto');
		return $productoBuscada;	
					
	}
	
	public static function TraerTodasLasProductos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from misproductos");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasProductos() ");
		$consulta->execute();			
		$arrProductos= $consulta->fetchAll(PDO::FETCH_CLASS, "producto");	
		return $arrProductos;
	}
	
	public static function BorrarProducto($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from misproductos WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarProducto(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarProducto($producto)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update misproductos 
				set nombre=:nombre,
				porcentaje=:porcentaje
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarProducto(:id,:nombre,:apellido,:foto)");
			$consulta->bindValue(':id',$producto->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':porcentaje', $producto->porcentaje, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarProducto($producto)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into misproductos (nombre,porcentaje)values(:nombre,:porcentaje)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarProducto (:nombre,:apellido,:dni,:foto)");
		$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':porcentaje', $producto->porcentaje, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}


}
