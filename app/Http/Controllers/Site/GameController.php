<?php

namespace App\Http\Controllers\Site;

use App\Contracts\GameInterface;
use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{

    private GameInterface $gameRepo;

    public function __construct(GameInterface $gameRepo)
    {
        $this->gameRepo = $gameRepo;
    }


    /**
     * @param $tokenId
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index($tokenId)
    {
        $gameHistories = $this->gameRepo->getLastResults((int)$tokenId);

        return view('site.pages.history', compact('gameHistories'));
    }

    /**
     * @param Token $token
     * @return RedirectResponse
     */
    public function store(Token $token)
    {
        $randomNumber = rand(1, 1000);
        $result = $randomNumber % 2 == 0 ? 'win' : 'lose';
        switch (true) {
            case $randomNumber > 900:
                $winningAmount = $randomNumber*0.8;
                break;
            case $randomNumber > 600:
                $winningAmount = $randomNumber*0.6;
                break;
            case $randomNumber > 300:
                $winningAmount = $randomNumber*0.2;
                break;
            default:
                $winningAmount = $randomNumber*0.1;
        }
        $gameData = [
            'random_number'     =>  $randomNumber,
            'result'            =>  $result,
            'token_id'          =>  $token->id,
            'winning_amount'    =>  $result != 'lose' ? $winningAmount : 0
        ];
        $game = $this->gameRepo->store($gameData);

        return redirect()->route('home', ['token' => $token->token, 'game' => $game->id]);

    }

}
