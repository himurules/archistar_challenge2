<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AnalyticTypes
 *
 * @package App\Models
 */
class AnalyticTypes extends Model
{
    protected $fillable = ['name','units', 'is_numeric', 'num_decimal_places'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function analytics()
    {
        return $this->hasMany(
            'App\Models\PropertyAnalytics',
            'analytic_type_id'
        );
    }

    /**
     * Associate Relationship with Properties
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(
            'App\Models\Properties',
            'property_analytics',
            'property_id',
            'analytic_type_id'
        );
    }
}
