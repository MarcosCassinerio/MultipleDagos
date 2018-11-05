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
            $anteriores = 0;
            $descripcion = $pregunta["descripcion"];
            $correctas = $pregunta["respuestas_correctas"];
            $incorrectas = $pregunta["respuestas_incorrectas"];
            $todasAnteriores = "";
            $ningunaAnteriores = "";
            if(!array_key_exists("ocultar_opcion_todas_las_anteriores",$pregunta)){
                $todasAnteriores = "Todas de las anteriores";
            }
            if(!array_key_exists("ocultas_opcion_ninguna_de_las_anteriores",$pregunta)){
                $ningunaAnteriores = "Ninguna de las anteriores";
            }
            array_push($this->preguntas, new Pregunta($descripcion, $correctas, $incorrectas, $todasAnteriores, $ningunaAnteriores));
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