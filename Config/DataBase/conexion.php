<?php
Class DataBase{
    Public static function Connect(){
        $db = new mysqli('localhost','root','','infocontrol');
        $db->query("SET NAME 'utf-8'");
        return $db;
    }
}