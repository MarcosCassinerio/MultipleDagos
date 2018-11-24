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

    public function __CONSTRUCT($descripcion, $correctas, $incorrectas, $todasAnteriores, $ningunaAnteriores){
        $this->descripcion = $descripcion;
        $this->correctas = $correctas;
        $this->incorrectas = $incorrectas;
        $this->todasAnteriores = $todasAnteriores;
        $this->ningunaAnteriores = $ningunaAnteriores;
        $this->respuestas = array_merge($correctas, $incorrectas);
    }
    
    public function Randomizar(){
        shuffle($this->respuestas);
        if ($this->todasAnteriores != null && !$this->estaTodasAnteriores()){
            array_push($this->respuestas, $this->todasAnteriores);
        }
        if ($this->ningunaAnteriores != null && !$this->estaNingunaAnteriores()){
            array_push($this->respuestas, $this->ningunaAnteriores);
        }
    }

    public function obtenerCorrecta(){
        $letra = [];
        if ((current($this->incorrectas)) == FALSE){
            array_push($letra, $this->obtenerLetra($this->todasAnteriores));
            return $letra;
        }
        
        if ((current($this->correctas)) == FALSE){
            array_push($letra, $this->obtenerLetra($this->ningunaAnteriores));
            return $letra;
        }

        $temp = $this->correctas;
        for ($correcta = current($this->correctas) ; $correcta != FALSE ; $correcta = next($this->correctas)){
            array_push($letra, $this->obtenerLetra($correcta));
        }
        $this->correctas = $temp;
        return $letra;
    }

    public function obtenerLetra($rta){
        $i = 0;
        $temp = $this->respuestas;
        for ($respuesta = current($this->respuestas) ; $respuesta != FALSE ; $respuesta = next($this->respuestas)){
            if ($rta == $respuesta){
                $this->respuestas = $temp;
                return $i;
            }
            $i++;
        }
    }

    public function estaTodasAnteriores(){
        $temp = $this->respuestas;
        for ($respuesta = current($this->respuestas) ; $respuesta != FALSE ; $respuesta = next($this->respuestas)){
            if ($this->todasAnteriores == $respuesta){
                $this->respuestas = $temp;
                return TRUE;
            }
        }
        $this->respuestas = $temp;
        return FALSE;
    }

    public function estaNingunaAnteriores(){
        $temp = $this->respuestas;
        for ($respuesta = current($this->respuestas) ; $respuesta != FALSE ; $respuesta = next($this->respuestas)){
            if ($this->ningunaAnteriores == $respuesta){
                $this->respuestas = $temp;
                return TRUE;
            }
        }
        $this->respuestas = $temp;
        return FALSE;
    }

    public function convertirLetra($letra){
        $nuevo = [];
        for($i = current($letra) ; $i != FALSE ; $i = next($letra)){
            switch($i){
                case 0:
                array_push($nuevo, "A");
                break;
                case 1:
                array_push($nuevo, "B");
                break;
                case 2:
                array_push($nuevo, "C");
                break;
                case 3:
                array_push($nuevo, "D");
                break;
                case 4:
                array_push($nuevo, "E");
                break;
                case 5:
                array_push($nuevo, "F");
                break;
                case 6:
                array_push($nuevo, "G");
                break;
                case 7:
                array_push($nuevo, "H");
                break;
            }
        }
        return $nuevo;
    }
}