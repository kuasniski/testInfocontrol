<?php
Class Utils{
    public static function getProvincias(){
       $jsonProvincias = file_get_contents("C:/wamp64/www/testInfocontrol/Lib/provincias/fileData.json");
       $provincias = json_decode($jsonProvincias,true);
        //var_dump($provincias);
        //die();
       return $provincias;        
    }
    public static function getUsuario($id){
        require_once 'models/user.php';
        $usuario = new User();
        $usuario->setId($id);
        $res = $usuario->getOneById();
        $res = $res->fetch_object();
        return $res;    
    }
}