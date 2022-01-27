<?php
date_default_timezone_set('Asia/Baku');
ob_start();
 require_once "db.php";
 require_once "crud.php";

 $db = new DBConnection;
 $CRUD=new CRUD;
 if(isset($_GET["sil"]) && $_GET["sil"]=="ok"){
     if($CRUD->DELETE("isciler",$_GET["id"])){
         unlink($_GET['img']);
     }

     header("Location:index.php");
 }
