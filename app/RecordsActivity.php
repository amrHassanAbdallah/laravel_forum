<?php


namespace App;


trait RecordsActivity
{
    // laravel will detect the boot method and boot the RecordsActivity trait
    protected static function bootRecordsActivity()
    {

        if (auth()->guest()) {
            return;
        }
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleted(function ($model) {
            $model->activity()->delete();
        });

    }

    protected static function getActivitiesToRecord()
    {
        return ['created', 'deleted'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'type' => $this->getActivityType($event),
            'user_id' => auth()->id()
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * @param $event
     * @return string
     * @throws \ReflectionException
     */
    protected function getActivityType($event): string
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }


}