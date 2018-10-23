<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 23/10/2018
 * Time: 12:16
 */

// src/OC/PlatformBundle/Antispam/OCAntispam.php

namespace OC\PlatformBundle\Antispam;

class OCAntispam
{
    /**
     * Vérifie si le texte est un spam ou non
     *
     * @param $text
     * @return bool
     */
    public function isSpam($text)
    {
        return strlen($text) < 50;
    }
}