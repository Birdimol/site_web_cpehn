<?php



class DatabaseManager
{
	private static $instance;
	private $db_connection;

	public static function getInstance()
	{
		if (self::$instance == null) {
			$className = __CLASS__;
			self::$instance = new $className();
		}
		return self::$instance;
	}

	public static function initializeConnection()
	{
		$db = self::getInstance();

		if($db->db_connection == null)
		{
                    try
                    {
                        $host = "mysql5-48.90";
                        $user = "cpehn001";
                        $password ="cPEHN6030";
                        $dbName = "cpehn001";
                        $opt = array(
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        );
                      $db->db_connection = new PDO('mysql:dbname='.$dbName.';host='.$host.';charset=UTF8',
                        $user,
                        $password,$opt);
                    }
                    catch (PDOException $e)
                    {
                      exit( 'Connexion échouée : ' . $e->getMessage());
                    }
		}
	}

	public static function getDb()
	{
		$db = self::getInstance();
		$db->initializeConnection();
		return $db->db_connection;
	}

	public static function CastForIn($string)
	{
		return utf8_decode($string);
	}

	public static function CastForOut($string)
	{
		return utf8_encode($string);
	}
}
