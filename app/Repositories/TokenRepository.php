<?php

namespace App\Repositories;

use App\Contracts\TokenInterface;
use App\Models\Token;

class TokenRepository implements TokenInterface
{

    protected Token $model;

    /**
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->model = $token;
    }

    /**
     * @param $data
     * @return mixed|void
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @param $token
     * @return mixed|void
     */
    public function getByToken($token)
    {
        return $this->model->where('token', $token)->first();
    }

    /**
     * @param $id
     * @param $data
     * @return mixed|void
     */
    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
