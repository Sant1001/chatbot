<?php
	class Database {
		private static $dbName 		= 'Chatbot' ;
		private static $dbHost 			= 'localhost' ;
		private static $dbUsername 		= 'chatbotUser';
		private static $dbUserPassword 	= 'chatbotPass';

		private static $cont  = null;

		public function __construct() {
			exit('Init function is not allowed');
		}

		public static function connect(){
		   // Una conexión a través de toda la aplicación
	    	if ( null == self::$cont ) {
		    	try {
		        	self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
		        }
		        catch(PDOException $e) {
		        	die($e->getMessage());
		        }
	       	}
	       	return self::$cont;
		}

		public static function disconnect() {
			self::$cont = null;
		}
	}
?>