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
            new Ship('Destroyer', 4),
            new Ship('Destroyer', 4)
        ];

        try {
            (new Game())->create($ships);
        } catch (\Exception $e) {

        }

        $this->setSession($ships, 0);
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

        return view("pages.play", compact('ships','mergedCoordinates'));
    }


    public function shotAction(Request $request): \Illuminate\Http\JsonResponse
    {
        $shot = $request->col . $request->row;


        $ships = session('ships');
        $shipsSunk = session('ships_sunk');

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


        $this->setSession($ships, $shipsSunk);

        if ($totalShips == $shipsSunk) {
            $message = 'Well done! You completed the game in '. $shots.' shots ';
        }

        return response()->json(['hit' => $hit, 'message' => $message]);
    }

    public function showAction()
    {
        $ships = session('ships');
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
        dump($mergedCoordinates);
        return view('pages.show', compact('mergedCoordinates'));
    }

    protected function setSession($ships, $shipsSunk): void
    {
        session(['ships' => $ships]);
        session(['ships_sunk' => $shipsSunk]);
    }

}
