<?php

namespace Parameter;

use Illuminate\Database\Eloquent\Model;
use Parameter\ParametersModelTrait;

class Parameter extends Model
{
    use ParametersModelTrait;

    protected $guarded = ['id'];
    protected $appends = ['humanizedCreatedAt','humanizedUpdatedAt'];
    protected $casts = ['meta'=>'array'];

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

    public function created_by_user()
    {
        // TODO: Configurable
        return $this->belongsTo('App\User', 'created_by_user_id');
    }

    public function category()
    {
		// TODO: Configurable
        return $this->belongsTo('Parameter\Parameter');
    }

    /* End: Relationships */

    public function getHumanizedCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getHumanizedUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($this->updated_at)->diffForHumans();
    }
}
