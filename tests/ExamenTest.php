<?php

namespace MultipleChoice;

require_once 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class ExamenTest extends TestCase {

    public function testLeerYamil() {
        $yamil = Yaml::parse(file_get_contents("./preguntas.yml"));
        $prueba = new Examen($yamil);
        $intentoUno = $prueba->getPreguntas();
        $intentoUno = $intentoUno[0]->respuestas[0];
        $intentoDos = $prueba->getPreguntas();
        $intentoDos = $intentoDos[0]->respuestas[0];
        $this->assertNotEquals($intentoUno, $intentoDos);
    }

    public function testTwigger(){
        $testeo = "test";
        $loader = new \Twig_Loader_Filesystem('tests');
        $twig = new \Twig_Environment($loader);
        \file_put_contents("hola.html", $twig->render("template.html", array('name' => $testeo)));
    }
}