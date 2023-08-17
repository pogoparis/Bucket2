<?php

namespace App\Services;

class Censurator
{
    const GROS_MOTS = ['caca', 'pipi', 'prout', 'connard','saloperie'];

    function purify($phrase): string {
        foreach (self::GROS_MOTS as $mot){
            $phrase = str_replace($mot, $mot[0].str_repeat("*", mb_strlen($mot)-2).$mot[-1], $phrase);
        }
        return $phrase;
    }

}