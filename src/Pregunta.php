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
        $this->respuestas = array_merge($this->correctas, $this->incorrectas);
    }

    public function Randomizar(){
        $cantidadPreguntas = count($this->respuestas);
        $this->respuestas = array_rand($this->respuestas, $cantidadPreguntas);
    }

}