<?php
$siyahi=$CRUD->Select("isciler",1);

if(isset($_POST["send"])){
    $olcu = $_FILES["sekil"]["size"];
    $tip = $_FILES["sekil"]["type"];
    $tmp = $_FILES["sekil"]["tmp_name"];
    $ad = $_FILES["sekil"]["name"];
    $tipler = ["image/png","image/jpeg","image/gif"];
    $yol = "./img/".$ad;
    if ($olcu > 0 && !in_array($tip,$tipler)) {
       header("Location:index.php?status=no");       
       exit;
    }
    $column = '
    adsoyad=:ad,
    vezife=:vezife,
    maas=:maas,
    email=:email,
    tarix=:tarix,
    av=:av,
    img=:sekil
    ';
    $arr = [
        "ad"=>$_POST["ad"],
        "vezife" => $_POST["vezife"],
        "maas" => $_POST["maas"],
        "email" => $_POST["email"],
        "tarix"=>date('Y-m-d h:i:s'),
        "av" => $_POST["av"],
        "sekil" =>substr($yol,2)
        
    ];
    if ($CRUD->INSERT("isciler", $column,$arr)) {
        move_uploaded_file($tmp, $yol);
        header("Location:index.php?status=ok");    
        print_r($arr);
        exit;
    } else {
       header("Location:index.php?status=no");        
        exit;
    }

 }
 if(isset($_POST["redakte"])){
 
    $olcu=$_FILES["sekil"]["size"];
    $tip=$_FILES["sekil"]["type"];
    $ad=$_FILES["sekil"]["name"];
    $tmp=$_FILES["sekil"]["tmp_name"];
    $tipler=["image/png","image/jpg","image/gif","image/jpeg","image/webp"];
    $yol = "./img/".$ad;
    $ksekil=$_POST["ksekil"];
    print_r($ksekil);
    $id=$_POST["id"];
    if($olcu>0 && !in_array($tip,$tipler) )
    {
       header("Location:index.php?status=no");
       exit;
    }
    $column="
    adsoyad=:ad,
    vezife=:vezife,
    maas=:maas,
    email=:email,
    img=:sekil
    where id = {$id}
    ";
    $arr=[
        "ad"=>$_POST["ad"],
        "vezife" => $_POST["vezife"],
        "maas" => $_POST["maas"],
        "email" => $_POST["email"],
        "sekil"=>$olcu>0 ? substr($yol,2) : substr($ksekil,2)
    ];

    if( $CRUD->UPDATE("isciler",$column,null,$arr)){
       if($olcu>0){
           unlink($ksekil);
           move_uploaded_file($tmp,$yol);
           
       }
       header("Location:index.php?status=ok");
       exit;
    }

    else{
       header("Location:index.php?status=no");
       exit;
    }

   
  }

