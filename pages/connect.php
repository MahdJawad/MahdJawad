<?php
session_start();
include_once "functions.php";
$connection = mysqli_connect("localhost", "root", "", "sirbarh");

$pages['common']=array('accueil','logout','login','users');
$pages['1']=array('users','employes','echelons','primes','indemnites','classes','mois','grilles','categories');
$pages['2']=array('');
