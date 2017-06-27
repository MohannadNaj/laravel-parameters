<?php

namespace Parameter;

use Illuminate\Database\Eloquent\Model;
use Parameter\ParametersModelTrait;

class Parameter extends Model
{
    use ParametersModelTrait;

    protected $guarded = ['id'];

    public static function name($field)
    {
        // latest: in case the same field is created twice at table, get the latest value
        return static::where('name', $field)->get()->last();
    }

    /* Start: Relationships */

    public function updated_by_user()
    {
		// TODO: Configurable
        return $this->belongsTo('App\User', 'updated_by_user_id');
    }

    public function added_by_user()
    {
		// TODO: Configurable
        return $this->belongsTo('App\User', 'updated_by_user_id');
    }

    /* End: Relationships */
    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \WhichBeach\Beach\Support\BeachCollection
     */
    public function newCollection(array $models = [])
    {
        return parent::newCollection($models);
        // TODO: custom collection, has a `fresh` method
    }

}
