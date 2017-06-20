<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
	protected $guarded = ['id'];

    public static function name($field)
    {
        // latest: in case the same field is created twice at table, get the latest value
        return static::where('name', $field)->get()->last();
    }
    
    public function rules()
    {
        // TODO: Configurable Rules
        switch ($this->type) {
            case 'boolean':
                $rule = 'required|in:0,1';
            break;
            case 'integer':
                $rule = 'required|integer';
            break;
            default:
                $rule = 'required';
            break;
        }
        return $rule;
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
}
