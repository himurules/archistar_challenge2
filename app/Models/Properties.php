<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

/**
 * Class Properties
 *
 * @package App\Models
 */
class Properties extends Model
{
    protected $fillable = ['id','guid', 'suburb', 'state', 'country'];

    /**
     * Boot method to handle events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(
            function ($properties) {
                $properties->guid = Uuid::generate()->string;
            }
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function analytics()
    {
        return $this->hasMany(
            'App\Models\PropertyAnalytics',
            'property_id'
        );
    }

    /**
     * List of related analyticTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function propertyAnalytics()
    {
        return $this->belongsToMany(
            'App\Models\AnalyticTypes',
            'property_analytics',
            'property_id',
            'analytic_type_id'
        );
    }
}
