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
        array_merge($respuestas, $correctas, $incorrectas);
    }

}