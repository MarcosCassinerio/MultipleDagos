<?php

namespace MultipleChoice;

use PHPUnit\Framework\TestCase;

class ExamenTest extends TestCase {

    public function testLeerYamil() {
        $yamil = yaml_parse_file("../preguntas.yml");
        var_dump($yamil);
    }
}
