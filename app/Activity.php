<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    /**
     * @param int $user_id
     * @param $take
     * @return mixed
     */
    public static function feed(int $user_id, $take = 50)
    {
        return static::where('user_id', $user_id)
            ->with('subject')
            ->latest()
            ->get()
            ->take($take)
            ->groupBy(function ($activity) {
                return $activity->created_at->format("Y-m-d");
            });
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
