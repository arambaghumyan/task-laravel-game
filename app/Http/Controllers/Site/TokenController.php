<?php

namespace App\Http\Controllers\Site;

use App\Contracts\TokenInterface;
use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokenController extends Controller
{

    private TokenInterface $tokenRepo;

    /**
     * @param TokenInterface $tokenRepo
     */
    public function __construct(TokenInterface $tokenRepo)
    {
        $this->tokenRepo = $tokenRepo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $token = $this->tokenRepo->getById($request->get('token_id'));
            do {
                $randomToken = Str::random(32);
            } while ($this->tokenRepo->getByToken($randomToken));
            DB::beginTransaction();
            $this->tokenRepo->destroy($token->id);
            $newToken = $this->tokenRepo->store([
                'token'         => $randomToken,
                'user_id'       => $token->user_id,
                'expired_at'    =>  now()->add('days', 7)
            ]);
            DB::commit();

            return redirect()->route('home', $newToken->token);
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back();
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function expired()
    {
        return view('site.pages.expired');
    }

    /**
     * @param Token $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivate(Token $token)
    {
        $this->tokenRepo->update($token->id, [
            'expired_at'    =>  now()
        ]);

        return redirect()->route('tokens.expired', ['token' => $token->token]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->tokenRepo->destroy($id);

        return redirect()->route('home');
    }
}
