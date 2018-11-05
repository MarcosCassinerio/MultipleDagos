<?php

namespace MultipleChoice;

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
}