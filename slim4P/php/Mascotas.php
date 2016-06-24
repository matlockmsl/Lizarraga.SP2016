<?php
require_once"accesoDatos.php";
class Mascota
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $edad;
  	public $fecha_nac;
  	public $tipo;
	public $sexo;
	public $foto;

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
			$obj = Mascota::TraerUnaMascota($id);
			$this->nombre = $obj->nombre;
			$this->edad = $obj->edad;
			$this->fecha_nac = $obj->fecha_nac;
			$this->tipo = $obj->tipo;
			$this->sexo = $sexo;
			$this->foto = $obj->foto;
		}
	}
//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaMascota($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from mascotas where id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaMascota(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$mascotaBuscada= $consulta->fetchObject('mascota');
		return $mascotaBuscada;	
					
	}
	
	public static function TraerTodasLasMascotas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from mascotas");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasMascotas() ");
		$consulta->execute();			
		$arrMascotas= $consulta->fetchAll(PDO::FETCH_CLASS, "mascota");	
		return $arrMascotas;
	}
	
	public static function BorrarMascota($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from mascotas WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarMascota(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarMascota($mascota)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update mascotas 
				set nombre=:nombre,
				edad=:edad,
				fecha_nac=:fecha_nac,
				tipo=:tipo,
				sexo=:sexo,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarMascota(:id,:nombre,:apellido,:foto)");
			$consulta->bindValue(':id',$mascota->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$mascota->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':edad', $mascota->edad, PDO::PARAM_STR);
			$consulta->bindValue(':fecha_nac', $mascota->fecha_nac, PDO::PARAM_STR);
			$consulta->bindValue(':tipo',$mascota->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':sexo', $mascota->sexo, PDO::PARAM_STR);
			$consulta->bindValue(':foto', $mascota->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarMascota($mascota)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mascotas (nombre,edad,fecha_nac,tipo,sexo,foto)values(:nombre,:edad,:fecha_nac,:tipo,:sexo,:foto)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarMascota (:nombre,:apellido,:dni,:foto)");
		$consulta->bindValue(':nombre',$mascota->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':edad', $mascota->edad, PDO::PARAM_STR);
		$consulta->bindValue(':fecha_nac', $mascota->fecha_nac, PDO::PARAM_STR);
		$consulta->bindValue(':tipo', $mascota->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':sexo', $mascota->sexo, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $mascota->foto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}


}
