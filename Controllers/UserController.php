<?php
require_once 'models/user.php';
require_once 'helpers/utils.php';
Class UserController{
    
    Public function registerEdit(){
        require_once 'views/user/register-edit.php';
    }
    
    Public function save(){

        function existeUserName($username){
            $res = false;
            $usuario = new User();
            $usuario->setUsername($username);
            $consulta = $usuario->getOneByUsername();
            if($consulta && $consulta->num_rows >= 1){
                $res = true;
            }
            return $res;
        }    
        function fechaValida($fecha){
            $date = date_create("now");
            $date = date_format($date,"Y-m-d");
          
            if ($fecha > $date){
                $res=false;
            }else{
                $res= true;
            }
            return $res;
        }
        function existeProvincia($id){
            $provincias = utils::getprovincias();
            $res = false;
            foreach($provincias as $provincia){
                if($res){break;}
                for($i = 0; $i <= count($provincia); $i++){
                    if($provincia[$i]['id'] == $id){
                        $res=true;
                        break;
                    }
                }
            }
            return $res;
        }
        function setMsjExito(){
            $respuesta['exito']="Datos guardados con exito.";
            return $respuesta;
        }
        //var_dump($_POST['terminos']);
        //die();
        $respuesta = Array();
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
        $username = isset($_POST['username']) ? $_POST['username'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
        $numero = isset($_POST['numero']) ? $_POST['numero'] : false;
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
        $tereminos = isset($_POST['terminos']) ? $_POST['terminos'] : 0;
        if(!$nombre || empty($nombre) || is_numeric($nombre)){
           $respuesta['error']['nombre'] = "El nombre no contiene caracteres validos."; 
        }
        if(!$apellido || empty($apellido) || is_numeric($apellido)){
           $respuesta['error']['apellido'] = "El apellido no contiene caracteres validos."; 
        }
        if(!$username || existeUserName($username)){
            if(!$id){
                $respuesta['error']['username'] = "El username ya se encuentra registrado.";
            }
        }
        if(!$password || !preg_match("/[0-9]/", $password) || !preg_match("/[a-zA-Z]/", $password) || strlen($password) < 8){
            $respuesta['error']['password'] = "El password debe ser alfanumerica y debe contener 8 caracteres o mas.";
        }
        if(!existeProvincia($provincia)){
            $respuesta['error']['provincia'] = "La provincia seleccionada no existe.";
        }
        if (!$numero == ""){
            if($numero < 1 || $numero > 100){
                $respuesta['error']['numero'] = "El numero debe ser del 1 al 100.";
            } 
        }
        if(!$fecha || !fechaValida($fecha)){
            $respuesta['error']['fecha']="La fecha debe ser menor o igual al dia de hoy.";
        }

        if(count($respuesta) == 0){
            $usuario = new User();
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setUsername($username);
            $usuario->setPassword($password);
            $usuario->setId_provincia($provincia);
            $usuario->setNumero($numero);
            $usuario->setFecha($fecha);
            $usuario->setAcepta_terminos($tereminos);
            if($id){
                $usuario->setId($id);
                $edit = $usuario->update();
            }else{
                $insert = $usuario->save();
            }
            
            if(isset($insert) && $insert){
                $usu=$usuario->getUltimoid();
                $usu=$usu->fetch_object();
                $respuesta = setMsjExito();
                $respuesta['id']= $usu->id;
            }else if(isset($edit) && $edit){
                $respuesta = setMsjExito();
                $respuesta['id'] = $id;
            }
        }else{
            
        }
        $jsonrespuesta = json_encode($respuesta,true);
        echo $jsonrespuesta;
    }

}