<?php

namespace App\Enums;

enum TipoSentidoSensor:string{
    case Todas = 'Todas';
    case Forward = 'forward';
    case Reverse = 'reverse';
    case Unknown = 'unknown';
}