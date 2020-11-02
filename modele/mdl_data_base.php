<?php
include_once("modele/class_pdo.php");
class mdl_data_base extends class_pdo{

	// public  static function getclass_pdo(){
	// 	if(class_pdo::$monclass_pdo==null){
	// 		class_pdo::$monclass_pdo= new mdl_data_base();
	// 	}
	// 	return class_pdo::$monclass_pdo;
    // }

	function dateUsToFr($date){
  
        $m = substr($date,5,2);
        $j = substr($date,8,2);
        $a = substr($date,0,4);
      
        $datefr = $j.'.'.$m.'.'.$a;
      
        return $datefr;
    }
}
?>