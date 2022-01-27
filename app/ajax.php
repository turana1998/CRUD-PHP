<?php
require_once "db.php";
require_once "crud.php";

$db = new DBConnection;
$CRUD=new CRUD;

if(isset($_POST['change'])){
    $column="
    av=:av
    where id=:id
    ";
    $arr=[
        "av"=>$_POST["value"],
        "id"=>$_POST["id"],
    ];

    echo $CRUD->UPDATE("isciler",$column,null,$arr) ? true : null;
}
if(isset($_POST['search'])){
    $str=$_POST["str"];
    $option=$_POST["option"];
    $siyahi=$CRUD->Select("isciler",1,"where `".$option."` LIKE '%".$str."%'");
    if($siyahi){
        for($i=0;$i<count($siyahi);$i++){
            if($option=="adsoyad"){
                echo "$i.--Ad:".$siyahi[$i]["adsoyad"]."<br>";
            }
            else{
                echo $i++."--Ad:".$siyahi[$i]["adsoyad"]."<br>".$option.$siyahi[$i][$option]."<br>";
            }
           
            // echo `kkskksksk $siyahi[$i][$option]`;
            
        }
        
    }
    else{
        echo "not find";
    }
}
