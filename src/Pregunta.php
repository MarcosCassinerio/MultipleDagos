<?php

namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;


class Pregunta implements PreguntaInterface{
    public $descripcion;
    public $respuestas;
    public $todasAnteriores;
    public $ningunaAnteriores;

    protected $correctas;
    protected $incorrectas;

    /**
     * 
     * AAAA
     * 
     */
    public function __CONSTRUCT($descripcion, $correctas, $incorrectas, $todasAnteriores, $ningunaAnteriores){
        $this->descripcion = $descripcion;
        $this->correctas = $correctas;
        $this->incorrectas = $incorrectas;
        $this->respuestas = array_merge($correctas, $incorrectas);
        $this->todasAnteriores = $todasAnteriores;
        $this->ningunaAnteriores = $ningunaAnteriores;
    }

    public function Randomizar(){
        shuffle($this->respuestas);
    }

}