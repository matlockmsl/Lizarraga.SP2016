<?php
	require_once("conexion.php");
	class Coche
	{
		private $_id;
		private $_marca;
		private $_modelo;
		private $_color;
		private $_foto;
		public function __construct($id, $marca, $modelo, $color, $foto)
		{
			$this->_id=$id;
			$this->_marca=$marca;
			$this->_modelo=$modelo;
			$this->_color=$color;
			$this->_foto=$foto;
		}
		public static function ToArray()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM coches ORDER BY id ASC");
			$sentencia->Execute();
			$coches=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $coches;
		}
		public static function BuscarCoche($id)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM coches WHERE id=:id");
			$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
			$sentencia->Execute();
			$coche=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $coche;
		}
		public function InsertarCoche()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("INSERT INTO coches(marca, modelo, color, foto) VALUES (:marca, :modelo, :color, :foto)");
			$sentencia->bindValue(":marca", $this->_marca, PDO::PARAM_STR);
			$sentencia->bindValue(":modelo", $this->_modelo, PDO::PARAM_STR);
			$sentencia->bindValue(":color", $this->_color, PDO::PARAM_STR);
			$sentencia->bindValue(":foto", $this->_foto, PDO::PARAM_STR);
			$sentencia->Execute();
			$id=$conexion->lastInsertId();
			$conexion=null;
			return $id;
		}
		public function ModificarCoche()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("UPDATE coches SET marca=:marca, modelo=:modelo, color=:color, foto=:foto WHERE id=:id");
			$sentencia->bindValue(":id", $this->_id, PDO::PARAM_INT);
			$sentencia->bindValue(":marca", $this->_marca, PDO::PARAM_STR);
			$sentencia->bindValue(":modelo", $this->_modelo, PDO::PARAM_STR);
			$sentencia->bindValue(":color", $this->_color, PDO::PARAM_STR);
			$sentencia->bindValue(":foto", $this->_foto, PDO::PARAM_STR);
			$sentencia->Execute();
			$conexion=null;
		}
		public static function EliminarCoche($id)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("DELETE FROM coches WHERE id=:id");
			$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
			$sentencia->Execute();
			$conexion=null;
		}
		public function getId()
		{
			return $this->_id;
		}
		public function getMarca()
		{
			return $this->_marca;
		}
		public function getModelo()
		{
			return $this->_modelo;
		}
		public function getColor()
		{
			return $this->_color;
		}
		public function getFoto()
		{
			return $this->_foto;
		}
	}
?>