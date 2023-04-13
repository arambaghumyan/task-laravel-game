<?php

namespace App\Http\Controllers\Site;

use App\Contracts\GameInterface;
use App\Contracts\TokenInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private TokenInterface $tokenRepo;
    private GameInterface $gameRepo;

    /**
     * @param TokenInterface $tokenRepo
     * @param GameInterface $gameRepo
     */
    public function __construct(TokenInterface $tokenRepo, GameInterface $gameRepo)
    {

        $this->tokenRepo = $tokenRepo;
        $this->gameRepo = $gameRepo;
    }

    /**
     * @param $linkToken
     * @param $gameId
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index($linkToken, $gameId = null)
    {
        $token = $linkToken;
        if ($linkToken) {
            $token = $this->tokenRepo->getByToken($linkToken);
        }
        $game = null;
        if ($gameId) {
            $game = $this->gameRepo->getById($gameId);
        }

    	return view('site.pages.home', compact('token', 'game'));
    }
}
