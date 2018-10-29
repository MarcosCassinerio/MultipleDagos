<?php

namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;

class Examen implements ExamenInterface{
    protected $preguntas;

    /**
     * 
     * AAAA
     * 
     */
    public function __CONSTRUCT($yamil){
        foreach ($yamil["preguntas"] as $pregunta) {
            $descripcion = $pregunta["descripcion"];
            $correctas = $pregunta["respuestas_correctas"];
            $incorrectas = $pregunta["respuestas_incorrectas"];
            $this->preguntas = array();
            array_push($this->preguntas, new Pregunta($descripcion, $correctas, $incorrectas));
        }
    }

    public function GetPreguntas(){
        shuffle($this->preguntas);
        foreach ($this->preguntas as $pregunta) {
            $pregunta->Randomizar();
        }
        return $this->preguntas;
    }

}