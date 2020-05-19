<?php
require_once("initBD.php"); //iniciando conexão com base de dados

extract($_POST);
$password = md5($password);
$sql = "SELECT * FROM user WHERE email LIKE '$email' AND password LIKE '$password';";
$user = $dbConn->query($sql)->fetchAll();

//contando resultados
$results = count($user);

if($results == 1){
    foreach ($user as $user_info) {
        extract($user_info);
        setcookie("login","true", strtotime( '+30 days' ));
        setcookie("id",$id, strtotime( '+30 days' ));
        setcookie("name",$name, strtotime( '+30 days' ));
        setcookie("email",$email, strtotime( '+30 days' ));
        setcookie("description",$description, strtotime( '+30 days' ));
        
        if(isset($return_path)){
            header("location: " . $return_path); 
        }
    }
}else{
    echo "Usuário não encontrado";
}