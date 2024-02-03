<?php

namespace App\Service;

use App\Service\IMastermind;

class Mastermind implements IMastermind
{
    private $propositions;
    private $t;
    private $secret;

    public function __construct($taille=4) {
        $this->propositions = [];
        $this->t = $taille;
        $this->secret = '1234';
    } // crée un nouveau jeu

    public function test($code) {

        $nbOk = 0;
        $nbKo = 0;

        for ($i = 0; $i < strlen($this->secret); $i++) {
            if ($this->secret[$i] == $code[$i]) {
                $nbOk++;
            } else {
                $nbKo;
            }
        }

        array_push($this->propositions, [$code,$nbOk,$nbKo]);
    } // teste une proposition
    
    public function getEssais() {
        return $this->propositions;
    } // ret les prop. préc.
    
    public function getTaille() {
        return $this->t;
    } // taille du jeu (4)
    
    public function isFini() {

    } // vrai si jeu fini : 4 bien placés

    public function serialize() {


        return serialize([$this->propositions,$this->t,$this->secret]);
    }

    public function unserialize(string $serializedData) {
        // $data = json_decode($serializedData);

        // var_dump($serializedData);
        // var_dump($data);

        // $this->propositions = $data['propositions'];
        // $this->t = $data['t'];
        // $this->secret = $data['secret'];

        list($x, $y, $z) = unserialize($serializedData);

        $this->propositions = $x;
        $this->t = $y;
        $this->secret = $z;

        // print("xyz<br>");
        // var_dump($x,$y,$z);

        return $x;
    }
}