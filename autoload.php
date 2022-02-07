<?php

function autocarga_clases($className){
    include 'controllers/'.$className.".php";
}

spl_autoload_register('autocarga_clases');