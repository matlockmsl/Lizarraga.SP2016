<?php
	class Conexion
	{
		public static function AccederDatos()
		{
			try
			{
				return $conexion=new PDO("mysql:host=localhost;charset=utf8;dbname=segundoparcial2016", "root", "");//("mysql:host=mysql.hostinger.com.ar;charset=utf8;dbname=u507415107_labiv", "u507415107_gaby", "gaby125");
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
				die();
			}
		}
	}
?>