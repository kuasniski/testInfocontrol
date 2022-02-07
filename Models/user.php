<?php
Class User{
    Private $id;
    Private $nombre;
    Private $apellido;
    Private $username;
    Private $password;
    Private $id_provincia;
    Private $numero;
    Private $fecha;
    Private $acepta_terminos;
    Private $db;
    
    function __construct() {
        $this->db = DataBase::Connect();
    }
    function getId() {
        return $this->id;
    }
    function getAcepta_terminos() {
        return $this->acepta_terminos;
    }

    function setAcepta_terminos($acepta_terminos) {
        $this->acepta_terminos = $acepta_terminos;
    }

        function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return password_hash($this->password,PASSWORD_BCRYPT,['cost' => 4]);
    }

    function getId_provincia() {
        return $this->id_provincia;
    }

    function getNumero() {
        return $this->numero;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido($apellido) {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    function setUsername($username) {
        $this->username = $this->db->real_escape_string($username);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setId_provincia($id_provincia) {
        $this->id_provincia = $id_provincia;
    }

    function setNumero($numero) {
        $this->numero = intval($numero);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    public function getOneByUsername(){
        $query = "SELECT * FROM usuarios WHERE username = '{$this->getUsername()}';";
        $res = $this->db->query($query);
        return $res;
    }

    public function save(){
        $query = "INSERT INTO usuarios VALUES (NULL,'{$this->getNombre()}','{$this->getApellido()}','{$this->getUsername()}','{$this->getPassword()}','{$this->getId_provincia()}',{$this->getNumero()},'{$this->getFecha()}',{$this->getAcepta_terminos()});";
        $res = $this->db->query($query);
        return $res;
    }
    public function update(){
        $query = "UPDATE usuarios SET nombre = '{$this->getNombre()}', apellido='{$this->getApellido()}',username='{$this->getUsername()}',password='{$this->getPassword()}',id_provincia='{$this->getId_provincia()}',numero={$this->getNumero()},fecha='{$this->getFecha()}',acepta_terminos={$this->getAcepta_terminos()} WHERE id = {$this->getId()};";
        $res = $this->db->query($query);
        return $res;
    }
    public function getUltimoid(){
        $query="SELECT MAX(id) as id from usuarios;";
        $res = $this->db->query($query);
        return $res;
    }
    public function getOneById(){
        $query = "SELECT * FROM usuarios WHERE id = '{$this->getId()}';";
        $res = $this->db->query($query);
        return $res;
    }

}