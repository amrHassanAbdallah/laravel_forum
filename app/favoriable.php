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

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function unfavorite()
    {
        $this->favorites()->where(['user_id' => auth()->id()])->delete();
    }
}