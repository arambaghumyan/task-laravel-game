<?php

namespace App\Contracts;

interface TokenInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $token
     * @return mixed
     */
    public function getByToken($token);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);
}
