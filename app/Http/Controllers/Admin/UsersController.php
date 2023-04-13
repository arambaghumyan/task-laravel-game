<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TokenInterface;
use App\Http\Controllers\Controller;
use Exception;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Contracts\Admin\UserInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsersController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepo->index();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $userRegisterRequest)
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


            return redirect()->route('users.index');
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRegisterRequest $userRegisterRequest, User $user)
    {
        $this->userRepo->update($user->id, [
            'name' => $userRegisterRequest->get('name'),
            'phone' => $userRegisterRequest->get('phone'),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userRepo->delete($user->id);

        return redirect()->route('users.index');
    }
}
