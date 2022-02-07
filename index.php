<?php
ob_start();
session_start();
    require_once 'Config/DataBase/conexion.php';
    require_once 'helpers/utils.php';
    require_once 'autoload.php';
    if (isset($_GET['controller'])) {
        $nombreControlador = $_GET['controller'] . "Controller";
        $titulo = $_GET['controller'];
    }elseif(!isset($_GET['controller'])){
        $nombreControlador = "UserController";
        $titulo = "";
    } else {
        echo 'Error controlador';
    }

    if (isset($_GET['action'])) {
        $nombreAccion = $_GET['action'];
    }elseif(!isset($_GET['action'])) {
        $nombreAccion = "registerEdit";
    }
    else {
        echo 'Error al cargar acction';
    }

    if (class_exists($nombreControlador) && method_exists($nombreControlador, $nombreAccion)) {
        $controlador = new $nombreControlador();
        $controlador->$nombreAccion();
    }else{
        echo 'Error al cargar la clase';
    }
