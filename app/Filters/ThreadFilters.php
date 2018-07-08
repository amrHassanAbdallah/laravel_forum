<?php


namespace App\Filters;


use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['username'];

    protected function username($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->query->where('user_id', $user->id);

    }


}