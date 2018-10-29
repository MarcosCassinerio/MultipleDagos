<?php

namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;

class Pregunta implements PreguntaInterface{
    public $descripcion;
    public $respuestas;

    protected $correctas;
    protected $incorrectas;

    /**
     * 
     * AAAA
     * 
     */
    public function __CONSTRUCT($descripcion, $correctas, $incorrectas){
        $this->descripcion = $descripcion;
        $this->correctas = $correctas;
        $this->incorrectas = $incorrectas;
        $this->respuestas = array_merge($correctas, $incorrectas);
    }

    public function Randomizar(){
        shuffle($this->respuestas);
    }

}