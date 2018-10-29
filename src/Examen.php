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
        $this->preguntas = array();
        foreach ($yamil["preguntas"] as $pregunta) {
            $descripcion = $pregunta["descripcion"];
            $correctas = $pregunta["respuestas_correctas"];
            $incorrectas = $pregunta["respuestas_incorrectas"];
            array_push($this->preguntas, new Pregunta($descripcion, $correctas, $incorrectas));
        }
    }

    public function GetPreguntas(){
        $p = $this->preguntas;
        foreach ( $this->preguntas as &$pregunta) {
            $pregunta->Randomizar();
        }
        shuffle($this->preguntas);
        return $this->preguntas;
    }

}