<?php

namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;


class Pregunta implements PreguntaInterface {
    public $descripcion;
    public $respuestas;
    public $todasAnteriores;
    public $ningunaAnteriores;

    protected $correctas;
    protected $incorrectas;

    public function __CONSTRUCT($descripcion, $correctas, $incorrectas, $todasAnteriores, $ningunaAnteriores) {
        $this->descripcion = $descripcion;
        $this->correctas = $correctas;
        $this->incorrectas = $incorrectas;
        $this->todasAnteriores = $todasAnteriores;
        $this->ningunaAnteriores = $ningunaAnteriores;
        $this->respuestas = array_merge($correctas, $incorrectas);
    }
    
    public function Randomizar() {
        shuffle($this->respuestas);
        if ($this->todasAnteriores != null) {
            $this->ponerTodasAnteriores();
        }
        if ($this->ningunaAnteriores != null) {
            $this->ponerNingunaAnteriores();
        }
    }

    public function obtenerCorrecta() {
        $letra = [];
        if ((current($this->incorrectas)) == false) {
            array_push($letra, $this->obtenerLetra($this->todasAnteriores));
            return $letra;
        }
        
        if ((current($this->correctas)) == false) {
            array_push($letra, $this->obtenerLetra($this->ningunaAnteriores));
            return $letra;
        }

        $temp = $this->correctas;
        for ($correcta = current($this->correctas) ; $correcta != false ; $correcta = next($this->correctas)) {
            array_push($letra, $this->obtenerLetra($correcta));
        }
        $this->correctas = $temp;
        return $letra;
    }

    public function obtenerLetra($rta) {
        $i = 1;
        $temp = $this->respuestas;
        for ($respuesta = current($this->respuestas) ; $respuesta != false ; $respuesta = next($this->respuestas)) {
            if ($rta == $respuesta) {
                $this->respuestas = $temp;
                return $i;
            }
            $i++;
        }
    }

    public function ponerTodasAnteriores() {
        $temp = [];
        for ($respuesta = current($this->respuestas) ; $respuesta != false ; $respuesta = next($this->respuestas)) {
            if ($this->todasAnteriores != $respuesta) {
                array_push($temp, $respuesta);
            }
        }
        array_push($temp, $this->todasAnteriores);
        $this->respuestas = $temp;
    }

    public function ponerNingunaAnteriores() {
        $temp = [];
        for ($respuesta = current($this->respuestas) ; $respuesta != false ; $respuesta = next($this->respuestas)) {
            if ($this->ningunaAnteriores != $respuesta) {
                array_push($temp, $respuesta);
            }
        }
        array_push($temp, $this->ningunaAnteriores);
        $this->respuestas = $temp;
    }

    public function convertirLetra($letra) {
        $nuevo = [];
        for ($i = current($letra) ; $i != false ; $i = next($letra)) {
            switch($i) {
                case 1:
                    array_push($nuevo, "A");
                    break;
                case 2:
                    array_push($nuevo, "B");
                    break;
                case 3:
                    array_push($nuevo, "C");
                    break;
                case 4:
                    array_push($nuevo, "D");
                    break;
                case 5:
                    array_push($nuevo, "E");
                    break;
                case 6:
                    array_push($nuevo, "F");
                    break;
                case 7:
                    array_push($nuevo, "G");
                    break;
                case 8:
                    array_push($nuevo, "H");
                    break;
            }
        }
        return $nuevo;
    }
}