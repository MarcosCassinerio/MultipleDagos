<?php

namespace MultipleChoice;

require_once 'vendor/autoload.php';
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
            $todasAnteriores = "";
            $ningunaAnteriores = "";
            if(!array_key_exists("ocultar_opcion_todas_las_anteriores",$pregunta)){
                $todasAnteriores = "Todas las anteriores";
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

    public function GenerarExamen($cantidadDeTemas, $numeroDeEvaluacion){
        $loader = new \Twig_Loader_Filesystem('tests');
        $twig = new \Twig_Environment($loader);
        for($i=0; $i<$cantidadDeTemas; $i++){
            $preguntas = $this->GetPreguntas();
            $respuestas = [];
            $j = 0;
            foreach ($this->preguntas as $pregunta) {
                $letras = $pregunta->obtenerCorrecta();
                $letras = $pregunta->convertirLetra($letras);
                array_push($respuestas, $letras);
                $j++;
            }
            file_put_contents("rta".($i+1).".html", $twig->render("respuestas.html", array('respuestas' => $respuestas, 'numero' => $numeroDeEvaluacion, 'tema' => ($i+1))));
            file_put_contents("tema".($i+1).".html", $twig->render("template.html", array('preguntas' => $preguntas, 'numero' => $numeroDeEvaluacion, 'tema' => ($i+1))));
        }
    }

}
