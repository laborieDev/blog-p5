<?php
include_once("modele/class_pdo.php");
class mdl_data_base extends class_pdo{

	public  static function getclass_pdo(){
		if(class_pdo::$monclass_pdo==null){
			class_pdo::$monclass_pdo= new mdl_data_base();
		}
		return class_pdo::$monclass_pdo;
    }


}
?>