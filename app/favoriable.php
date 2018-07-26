<?php


namespace App;


trait favoriable
{

    public function favorite()
    {
        if (!$this->isFavorited()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }

    }

    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();

    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}