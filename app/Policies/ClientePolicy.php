<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClientePolicy
{
    use HandlesAuthorization;


    public function dono(User $user, Cliente $cliente)
    {
        return $user->id ===$cliente->user_id
            ? Response::allow()
            : Response::deny('NOT FOUND');
    }
}
