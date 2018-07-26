<?php


namespace App\Filters;


use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['username', 'popular'];


    /**
     * Filter query by user name
     * @param $username
     * @return mixed
     */
    protected function username($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->query->where('user_id', $user->id);

    }

    /**
     * Filter the query according to most popular threads
     * @return mixed
     */
    protected function popular()
    {
        $this->query->getQuery()->orders = [];
        return $this->query->orderBy('replies_count', 'desc');

    }

}