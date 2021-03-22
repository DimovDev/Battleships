<?php

namespace App\Models;

use App\Models\Field;


class Game
{
    /**
     * @var Field
     */
    private $field;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->field = new Field();
    }

    /**
     * @param array $ships
     * @throws \Exception
     */
    public function create(array $ships): void
    {
        foreach ($ships as $ship) {
            $this->field->placeShip($ship);
        }
    }

    /**
     * @return array
     */
    public function getField() : array
    {
        return $this->field->getField();
    }

}
