<?php

namespace App\Http\Controllers\Site;

use App\Contracts\TokenInterface;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Contracts\UserInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{


    private UserInterface $userRepo;
    private TokenInterface $tokenRepo;

    /**
     * @param UserInterface $userRepo
     * @param TokenInterface $tokenRepo
     */
    public function __construct(UserInterface $userRepo, TokenInterface $tokenRepo)
    {
        $this->userRepo = $userRepo;
        $this->tokenRepo = $tokenRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('site.pages.register');
    }

    /**
     * @param UserRegisterRequest $userRegisterRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(UserRegisterRequest $userRegisterRequest)
    {
    	try {
	    	$user = $this->userRepo->store([
	           'name' => $userRegisterRequest->get('name'),
	           'phone' => $userRegisterRequest->get('phone'),
	        ]);
            do {
                $randomToken = Str::random(32);
            } while ($this->tokenRepo->getByToken($randomToken));
            $tokenData = [
                'user_id'       => $user->id,
                'token'         => $randomToken,
                'expired_at'    => now()->add('days', 7),
            ];
            $token = $this->tokenRepo->store($tokenData);

        	return redirect()->route('home', $token->token);
    	} catch (Exception $exception) {
    		Log::error($exception);

            return redirect()->route('register')->withError($exception->getMessage());
    	}
    }
}
