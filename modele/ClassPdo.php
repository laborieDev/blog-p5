<?php
class ClassPdo{
      	private static $serveur='mysql:host=localhost';

      	private static $bdd='dbname=openclassrooms_p5';   		
      	private static $user='root' ;    		
      	private static $mdp='root' ;	

		protected static $monPdo;
		protected static $monClassPdo=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	public function __construct(){
    	ClassPdo::$monPdo = new PDO(ClassPdo::$serveur.';'.ClassPdo::$bdd, ClassPdo::$user, ClassPdo::$mdp);
		ClassPdo::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		ClassPdo::$monPdo = null;
	}

}
?>