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

    public function testGenerar(){
        $yamil = Yaml::parse(\file_get_contents("./preguntas.yml"));
        $prueba = new Examen($yamil);
        $prueba->GenerarExamen(2,0);
        $this->assertTrue(file_exists("rta1.html"));
        $this->assertTrue(file_exists("rta2.html"));
        $this->assertTrue(file_exists("tema1.html"));
        $this->assertTrue(file_exists("tema2.html"));
    }

}