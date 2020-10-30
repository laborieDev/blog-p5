<?php
class class_pdo{
      	private static $serveur='mysql:host=localhost';

      	private static $bdd='dbname=portfolio';   		
      	private static $user='root' ;    		
      	private static $mdp='root' ;	

		protected static $monPdo;
		protected static $monclass_pdo=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	protected function __construct(){
    	class_pdo::$monPdo = new PDO(class_pdo::$serveur.';'.class_pdo::$bdd, class_pdo::$user, class_pdo::$mdp);
		class_pdo::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		class_pdo::$monPdo = null;
	}

}
?>