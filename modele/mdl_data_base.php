<?php
include_once("modele/class_pdo.php");
class mdl_data_base extends class_pdo{

	public  static function getclass_pdo(){
		if(class_pdo::$monclass_pdo==null){
			class_pdo::$monclass_pdo= new mdl_data_base();
		}
		return class_pdo::$monclass_pdo;
    }

    function dateustofr($date){
  
        $m = substr($date,5,2);
        $j = substr($date,8,2);
        $a = substr($date,0,4);
      
        $datefr = $j.'.'.$m.'.'.$a;
      
        return $datefr;
    } 
    
    public function verifConnexion($login, $mdp){
        $req = "SELECT * FROM gestion_admin ";
		$rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetch();
        
        if(($login == $ligne['login'])&&($mdp == $ligne['mdp'])){
            return true;
        }

        return false;
    }

    public function getAllData($table){
        $req = "SELECT * FROM $table ORDER BY date DESC";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetchAll();
        return $ligne;
    }
    
    public function getFirstData($table){
        $req = "SELECT * FROM $table WHERE date = (SELECT MAX(date) FROM $table)";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function getAllAutonome($cat){
        $req = "SELECT * FROM v_autonome WHERE cat = $cat ORDER BY date DESC ";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetchAll();
        return $ligne;
    }

    public function getFirstAutonome($cat){
        $req = "SELECT * FROM v_autonome WHERE date = (SELECT MAX(date) FROM v_autonome WHERE cat = $cat) AND cat = $cat";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function getTitre($id, $table){
        $req = "SELECT titre FROM $table WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $titre = $rs->fetch();
        return $titre;
    }

    public function ajoutArticle($table, $titre, $resume, $url, $image, $cat){

        
        $titre = str_replace("'","\'",$titre);
        $resume= str_replace("'", "\'",$resume);
        
        $file_name=$image['name'];
	    $file_extension = strrchr($file_name,".");
        
        $file_tmp_name=$image['tmp_name'];
        
	    $extension_autorisees= array(".jpg", ".jpeg");
	    $file_dest = 'assets/images/work/'.$table."/".$file_name;

	    if(in_array($file_extension, $extension_autorisees)){
            if(move_uploaded_file($file_tmp_name, $file_dest)){
        
                if($table != "v_autonome"){
                    $req = "INSERT INTO $table (titre, resume, date, url, img) VALUES ('$titre','$resume', NOW(),'$url', '$file_dest')";
                }
                else{
                    $req = "INSERT INTO $table (titre, resume, date, url, img, cat) VALUES ('$titre','$resume', NOW(), '$url', '$file_dest', $cat)";
                }
                $rs = class_pdo::$monPdo->query($req);
            }
        }
    }

    public function getDataOfId($table, $id){
        $req = "SELECT * FROM $table WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function editArticle($table, $id, $titre, $resume, $url, $image, $cat){

        $titre = str_replace("'","\'",$titre);
        $resume= str_replace("'", "\'",$resume);

        if($table != "v_autonome"){
            $req = "UPDATE $table SET titre = '$titre', resume = '$resume', url = '$url', img = '$image' WHERE id = $id";
        }
        else{
            $req = "UPDATE $table SET titre = '$titre', resume = '$resume', url = '$url', img = '$image', cat = $cat WHERE id = $id";
        }
        $rs = class_pdo::$monPdo->query($req);

    }

    public function deleteArticle($table, $id){
        //Récupérer l'url de l'image
        $req = "SELECT img FROM $table WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        $ligne = $rs->fetch();
        
        $req = "DELETE FROM $table WHERE id = $id";
        $rs = class_pdo::$monPdo->query($req);
        unlink ($ligne['img']); //Supprimer l'image du serveurs
    }


}
?>