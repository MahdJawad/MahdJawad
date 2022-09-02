<?php
session_start();
//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
//use Doctrine\DBAL;

/*//..
$connectionParams = array(
    'dbname' => 'pdna_',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
    'port' => '3306',
    'charset' => 'UTF-8',
    'driver' => 'pdo_mysql'


);
$Connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);


var_dump($Connection);
!*/



$host = 'localhost';
$db   = 'pdna_';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function set_flash($title,$type,$message){
	if (!isset($_SESSION['Flash'])) {
		$_SESSION['Flash']= array();
	}
	$FLASH['Title'] = $title ;
	$FLASH['Type'] = $type ;
	$FLASH['Message'] = $message ;
	array_push($_SESSION['Flash'], $FLASH);
	return true;
}


function suppression($table, $identifiants){
	$host="127.0.0.1";
	$user="root";
	$pass="";
	$db="pdna_";
	$connect=mysqli_connect($host,$user,$pass,$db) or die("Impossible de se connecter au serveur");
	$Keys = "";
	$i=0;
	foreach($identifiants as $Key=>$Valeur)
	{
		if($i==0)
		{
			$Keys .= " ".$Key;
			if (preg_match("#^[0-9]{".strlen($Valeur)."}$#" ,$Valeur)) 
			{
				$Keys .= "=".mysqli_real_escape_string($connect,htmlentities($Valeur));
			} 
			else 
			{
				$Keys .= "='".mysqli_real_escape_string($connect,htmlentities($Valeur))."'";
			}
		}
		else
		{
			$Keys .= " and ".$Key;
			if (preg_match("#^[0-9]{".strlen($Valeur)."}$#" ,$Valeur)) 
			{
				$Keys .= "=".mysqli_real_escape_string($connect,htmlentities($Valeur));
			} 
			else 
			{
				$Keys .= "='".mysqli_real_escape_string($connect,htmlentities($valeur))."'";
			}
		}
			$i++;
	}
	$requete = "delete from $table where $Keys;" ;
	//echo $requete;
	$execution = mysqli_query($connect,$requete);
	$execution ?  $resultat = true : $resultat = false;
	return $resultat;
}
function ajout($table , $données)
{	
	$host="127.0.0.1";
	$user="root";
	$pass="";
	$db="pdna_";
	$connect=mysqli_connect($host,$user,$pass,$db) or die("Impossible de se connecter au serveur");

	$champs="";
	$valeurs="";
	$i=0;
	foreach($données as $champ=>$valeur)
	{
		//echo gettype($valeur);
		if($i==0)
		{
			$champs .= $champ; 
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) 
			{
				if ($valeur==NULL) {
				$valeurs .= 'NULL';	
				} else
				$valeurs .= mysqli_real_escape_string($connect,htmlentities($valeur));
			} 
			else 
			{
				if ($valeur==NULL) {
				$valeurs .= 'NULL';	
				} else
				$valeurs .= "'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";
			}
		}

		else
		{
			$champs .= ",".$champ;
			
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) {
				if ($valeur==NULL) {
				$valeurs .= ",".'NULL';	
				} else
				$valeurs .= ",".mysqli_real_escape_string($connect,htmlentities($valeur));} 
			else 
			{	if ($valeur==NULL) {
				$valeurs .= ",".'NULL';	
				} else
				$valeurs .= ",'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";}
		}
		$i++;
		
	}
	$requete = "insert into $table(".$champs.") values(".$valeurs.");" ;
	//echo $requete;
	$execution = mysqli_query($connect,$requete) or die(mysqli_error($connect));
	//var_dump($execution);die();
	$execution ?  $resultat = mysqli_insert_id($connect) : $resultat = false;
	return $resultat;
}

function modification($Table, $Donnees, $Identifiants)
{
	$host="127.0.0.1";
	$user="root";
	$pass="";
	$db="pdna_";
	$connect=mysqli_connect($host,$user,$pass,$db) or die("Impossible de se connecter au serveur");

	$Keys = "";
	$i=0;
	foreach($Identifiants as $Key=>$Valeur)
	{
		if($i==0)
		{
			$Keys .= " ".$Key;
			if (preg_match("#^[0-9]{".strlen($Valeur)."}$#" ,$Valeur)) 
			{
				$Keys .= "=".mysqli_real_escape_string($connect,htmlentities($Valeur));
			} 
			else 
			{
				$Keys .= "='".mysqli_real_escape_string($connect,htmlentities($Valeur))."'";
			}
		}
		else
		{
			$Keys .= " and ".$Key;
			if (preg_match("#^[0-9]{".strlen($Valeur)."}$#" ,$Valeur)) 
			{
				$Keys .= "=".mysqli_real_escape_string($connect,htmlentities($Valeur));
			} 
			else 
			{
				$Keys .= "='".mysqli_real_escape_string($connect,htmlentities($Valeur))."'";
			}
		}
			$i++;
	}
	
	$Datas = "";
	$i=0;
	foreach($Donnees as $Donne=>$Contenu)
	{
		if($i==0)
		{
			$Datas .= " ".$Donne;
			if (preg_match("#^[0-9]{".strlen($Contenu)."}$#" ,$Contenu)) 
			{
				$Datas .= "=".mysqli_real_escape_string($connect,htmlentities($Contenu));
			} 
			else 
			{
				$Datas .= "='".mysqli_real_escape_string($connect,htmlentities($Contenu))."'";
			}
		}
		else
		{
			$Datas .= " , ".$Donne;
			if (preg_match("#^[0-9]{".strlen($Contenu)."}$#" ,$Contenu)) 
			{
				$Datas .= "=".mysqli_real_escape_string($connect,htmlentities($Contenu));
			} 
			else 
			{
				$Datas .= "='".mysqli_real_escape_string($connect,htmlentities($Contenu))."'";
			}
		}
			$i++;
	}
	
	$requete = "UPDATE $Table SET $Datas WHERE $Keys;" ;
	//echo $requete;
	$execution = mysqli_query($connect,$requete);
	$execution ?  $resultat = true : $resultat = false;
	return $resultat;
	
}




function AjoutOk($table , $données)
{	
	$host="127.0.0.1";
	$user="root";
	$pass="";
	$db="pdna_";
	$connect=mysqli_connect($host,$user,$pass,$db) or die("Impossible de se connecter au serveur");

	$champs="";
	$valeurs="";
	$i=0;
	foreach($données as $champ=>$valeur)
	{
		//echo gettype($valeur);
		if($i==0)
		{
			$champs .= $champ;
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) 
			{
				$valeurs .= mysqli_real_escape_string($connect,htmlentities($valeur));
			} 
			else 
			{
				$valeurs .= "'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";
			}
		}
		else
		{
			$champs .= ",".$champ;
			
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) {$valeurs .= ",".mysqli_real_escape_string($connect,htmlentities($valeur));} else {$valeurs .= ",'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";}
		}
		$i++;
		
	}
	$requete = "insert into $table(".$champs.") values(".$valeurs.");" ;
//	echo $requete;
	$execution = mysqli_query($connect,$requete);
	$execution ?  $resultat = true : $resultat = false;
	return $resultat;
}


function AjoutId($table , $données)
{	
	$host="127.0.0.1";
	$user="root";
	$pass="";
	$db="pdna_";
	$connect=mysqli_connect($host,$user,$pass,$db) or die("Impossible de se connecter au serveur");

	$champs="";
	$valeurs="";
	$i=0;
	foreach($données as $champ=>$valeur)
	{
		//echo gettype($valeur);
		if($i==0)
		{
			$champs .= $champ;
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) 
			{
				if ($valeur==NULL) {
				$valeurs .= 'NULL';	
				} else
				$valeurs .= mysqli_real_escape_string($connect,htmlentities($valeur));
			} 
			else 
			{	
				if ($valeur==NULL) {
				$valeurs .= 'NULL';	
				} else
				$valeurs .= "'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";
			}
		}
		else
		{
			$champs .= ",".$champ;
			
			if (preg_match("#^[0-9]{".strlen($valeur)."}$#" ,$valeur)) {
				if ($valeur==NULL) {
				$valeurs .= ",".'NULL';	
				} else
				$valeurs .= ",".mysqli_real_escape_string($connect,htmlentities($valeur));
			} else 
			{	if ($valeur==NULL) {
				$valeurs .= ",".'NULL';	
				} else
				$valeurs .= ",'".mysqli_real_escape_string($connect,htmlentities($valeur))."'";}
		}
		$i++;
		
	}
	$requete = "insert into $table(".$champs.") values(".$valeurs.");" ;
	//echo $requete;
	$execution = mysqli_query($connect,$requete);

	$resultat = mysqli_insert_id($connect);
	//$execution ?  $resultat = true : $resultat = false;
	return $resultat;
}


function formater($nombre){
	if (($nombre == "") or ($nombre == null)) {
		return "-";		
	}
	return number_format(floatval($nombre), 0, ","," ");
}

function formatedec($nombre,$nbr){
	if (($nombre == "") or ($nombre == null)) {
		return "-";		
	}
	return number_format(floatval($nombre), $nbr, ","," ");
}

