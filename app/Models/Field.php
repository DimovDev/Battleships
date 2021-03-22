<?php

namespace App\Models;


use phpDocumentor\Reflection\Types\Integer;

class Field
{
    /**
     * @var Integer
     */
    public const ROWS = 10;

    /**
     * @var Integer
     */
    public const COLS = 10;
    /**
     * @var string
     */
    public const WATER = '.';
    /**
     * @var string
     */
    public const SHIP = 'x';
    /**
     * @var Integer
     */
    public const HORIZONTAL = 0;
    /**
     * @var Integer
     */
    public const VERTICAL = 1;
    /**
     * var Integer
     */
    public const MAX_TRIES = 1000 ;

    /**
     * @var array
     */

    private $field;

    /**
     * @var array
     */

    private $letters;

    public function __construct()
    {
        $this->setLetters();
        $this->setField();
    }

    private function setLetters(): void
    {
        $letters = range('A', 'J');
        $this->letters = array_combine(range(1, count($letters)), array_values($letters));
    }

    private function setField(): void
    {
        for ($i = 1; $i <= self::COLS; $i++) {
            for ($j = 1; $j <= self::ROWS; $j++) {
                $this->field[$this->letters[$i]][$j] = self::WATER;
            }
        }
    }

    public function getField() : array
    {
        return $this->field;
    }

    private function orientation() : int
    {
        return random_int(0, 1);
    }

    public function scanField(int $shipSize, int $startingLetter, int $startingNumber, int $orientation): bool
    {
        $j = 0;

        if (static::HORIZONTAL == $orientation) {
            for ($i = 1; $i < $shipSize + 1; $i++) {
                if (static::WATER != $this->field[$this->letters[$startingLetter + $j]][$startingNumber]) {
                    return false;
                }
                $j++;
            }
        } else {
            for ($i = 1; $i < $shipSize + 1; $i++) {
                if (static::WATER != $this->field[$this->letters[$startingLetter]][$startingNumber + $j]) {
                    return false;
                }
                $j++;
            }
        }

        return true;
    }
    public function placeShip(Ship $ship): void
    {
        $maxTries = 0;

        do {
            $orientation = $this->orientation();

            if (static::HORIZONTAL == $orientation) {
                $maxStartingPoint = static::COLS - $ship->getLength();
                $startingLetter = rand(1, $maxStartingPoint);
                $startingNumber = rand(1, static::ROWS);
            } else {
                $maxStartingPoint = static::ROWS - $ship->getLength();
                $startingLetter = rand(1, static::COLS);
                $startingNumber = rand(1, $maxStartingPoint);
            }

            $scanField = $this->scanField($ship->getLength(), $startingLetter, $startingNumber, $orientation);

            $maxTries++;

            if (static::MAX_TRIES === $maxTries) {
                throw new \Exception('Too many tries to deploy the ship!');
            }

        } while ($scanField != true);

        $j = 0;
        $coordinates = [];
        if (static::HORIZONTAL == $orientation) {
            for ($i = 1; $i < $ship->getLength() + 1; $i++) {
                $coordinates[] = $this->letters[$startingLetter + $j] . $startingNumber;
                $this->field[ $this->letters[$startingLetter + $j] ][$startingNumber] = static::SHIP;
                $j++;
            }
        } else {
            for ($i = 1; $i < $ship->getLength() + 1; $i++) {
                $coordinates[] = $this->letters[$startingLetter] . ($startingNumber + $j);
                $this->field[$this->letters[$startingLetter]][$startingNumber + $j] = static::SHIP;
                $j++;
            }
        }

        $ship->setCoordinates($coordinates);
    }


}
