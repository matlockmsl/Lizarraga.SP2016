<?php
	require_once("conexion.php");
	class Medico
	{
		private $_id_med;
		private $_especialidad;
		public function __construct($id_med, $especialidad)
		{
			$this->_id_med=$id_med;
			$this->_especialidad=$especialidad;
		}
		public static function ToArray()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM medicos");
			$sentencia->Execute();
			$medicos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $medicos;
		}
		public static function BuscarMedicos()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT u.*, m.especialidad FROM usuarios AS u, medicos AS m WHERE u.tipo='medico' AND u.id=m.id_med");
			$sentencia->Execute();
			$medicos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $medicos;
		}
		public static function BuscarMedico($id_med)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM medicos WHERE id_med=:id_med");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->Execute();
			$medico=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $medico;
		}
		public function InsertarMedico()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("INSERT INTO medicos(id_med, especialidad) VALUES (:id_med, :especialidad)");
			$sentencia->bindValue(":id_med", $this->_id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":especialidad", $this->_especialidad, PDO::PARAM_STR);
			$sentencia->Execute();
			$id=$conexion->lastInsertId();
			$conexion=null;
			return $id;
		}
		public function ModificarMedico()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("UPDATE medicos SET id_med=:id_med, especialidad=:especialidad WHERE id_med=:id_med");
			$sentencia->bindValue(":id_med", $this->_id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":especialidad", $this->_especialidad, PDO::PARAM_STR);
			$sentencia->Execute();
			$conexion=null;
		}
		public static function EliminarMedico($id_med)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("DELETE FROM medicos WHERE id_med=:id_med");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->Execute();
			$conexion=null;
		}
		public function getId()
		{
			return $this->_id_med;
		}
		public function getEspecialidad()
		{
			return $this->_especialidad;
		}
	}
?>