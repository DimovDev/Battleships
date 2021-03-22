<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Ship;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function indexAction()
    {
        return view('pages.index');
    }

    public function playGame()
    {
        $ships = [
            new Ship('Battleship', 5),
            new Ship('Destroyer 1', 4),
            new Ship('Destroyer 2', 4)
        ];
        (new Game())->create($ships);

        $this->setSession($ships, 0, 0);
        $coordinates = [];
        foreach ($ships as $ship) {
            $coordinates[] = $ship->coordinates;
        }
        $mergedCoordinates = [];
        foreach ($coordinates as $coordinate) {
            foreach ($coordinate as $value) {
                $mergedCoordinates[] = $value;
            }
        }

        return view("pages.play", compact('ships', 'mergedCoordinates'));
    }


    public function shotAction(Request $request): \Illuminate\Http\JsonResponse
    {
        $shot = $request->col . $request->row;


        $ships = session('ships');
        $shipsSunk = session('ships_sunk');
        $shots = session('shots');
        $shots++;
        $messageShots = 'Shots ' . $shots . '';

        $hit = false;
        $message = 'Miss!';

        $totalShips = count($ships);

        foreach ($ships as $ship) {
            if ($ship->checkHit($shot)) {
                $hit = true;
                $message = 'Hit! ';

                if ($ship->isSunk()) {
                    $message = 'Ship ' . $ship->getName() . ' sunk!';
                    $shipsSunk++;
                }
            }
        }


        $this->setSession($ships, $shipsSunk, $shots);

        if ($totalShips == $shipsSunk) {
            $message = 'Well done! You completed the game in ' . $shots . ' shots! ';
        }

        return response()->json(['hit' => $hit, 'message' => [$message ,$messageShots] ]);
    }


    protected function setSession($ships, $shipsSunk, $shots): void
    {
        session(['ships' => $ships]);
        session(['ships_sunk' => $shipsSunk]);
        session(['shots' => $shots]);
    }

}
