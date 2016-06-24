<?php
	require_once("conexion.php");
	class Turno
	{
		private $_id_med;
		private $_id_pac;
		private $_fecha;
		private $_estado;
		public function __construct($id_med, $id_pac, $fecha, $estado)
		{
			$this->_id_med=$id_med;
			$this->_id_pac=$id_pac;
			$this->_fecha=$fecha;
			$this->_estado=$estado;
		}
		public static function ToArray()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM turnos ORDER BY fecha");
			$sentencia->Execute();
			$medicos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $medicos;
		}
		public static function BuscarTurnos($id_med)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM turnos WHERE id_med=:id_med");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->Execute();
			$turnos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $turnos;
		}
		public static function BuscarTurnosPaciente($id_pac)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM turnos WHERE id_pac=:id_pac");
			$sentencia->bindValue(":id_pac", $id_pac, PDO::PARAM_INT);
			$sentencia->Execute();
			$turnos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $turnos;
		}
		public static function BuscarTurno($id_med, $fecha)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("SELECT * FROM turnos WHERE id_med=:id_med AND fecha LIKE :fecha");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":fecha", $fecha."%", PDO::PARAM_STR);
			$sentencia->Execute();
			$medico=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $medico;
		}
		public function InsertarTurno()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("INSERT INTO turnos(id_med, id_pac, fecha, estado) VALUES (:id_med, :id_pac, :fecha, :estado)");
			$sentencia->bindValue(":id_med", $this->_id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":id_pac", $this->_id_pac, PDO::PARAM_INT);
			$sentencia->bindValue(":fecha", $this->_fecha, PDO::PARAM_STR);
			$sentencia->bindValue(":estado", $this->_estado, PDO::PARAM_STR);
			$sentencia->Execute();
			$id=$conexion->lastInsertId();
			$conexion=null;
			return $id;
		}
		public function ModificarTurno()
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("UPDATE turnos SET id_med=:id_med, id_pac=:id_pac, fecha=:fecha, estado=:estado WHERE id_med=:id_med AND fecha=:fecha");
			$sentencia->bindValue(":id_med", $this->_id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":id_pac", $this->_id_pac, PDO::PARAM_INT);
			$sentencia->bindValue(":fecha", $this->_fecha, PDO::PARAM_STR);
			$sentencia->bindValue(":estado", $this->_estado, PDO::PARAM_STR);
			$sentencia->Execute();
			$conexion=null;
		}
		public static function EliminarTurnos($id_med)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("DELETE FROM turnos WHERE id_med=:id_med");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->Execute();
			$conexion=null;
		}
		public static function EliminarTurno($id_med, $fecha)
		{
			$conexion=Conexion::AccederDatos();
			$sentencia=$conexion->Prepare("DELETE FROM turnos WHERE id_med=:id_med AND fecha=:fecha");
			$sentencia->bindValue(":id_med", $id_med, PDO::PARAM_INT);
			$sentencia->bindValue(":fecha", $fecha, PDO::PARAM_STR);
			$sentencia->Execute();
			$conexion=null;
		}
	}
?>