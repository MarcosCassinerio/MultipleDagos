<?php

namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;

interface PreguntaInterface {
    public function Randomizar();

    public function obtenerCorrecta();

    public function obtenerLetra($rta);
}