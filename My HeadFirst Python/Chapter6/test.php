<?php

class NbaPlayer{
    function __construct($name){
        $this -> name = $name;
    }
}

$apolo = new NbaPlayer('apolo');
echo ($apolo->name."\n");