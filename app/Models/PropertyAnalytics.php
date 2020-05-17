<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyAnalytics
 *
 * @package App\Models
 */
class PropertyAnalytics extends Model
{
    protected $fillable = ['property_id','analytic_type_id','value'];

    /**
     * Return associated properties
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id');
    }

    /**
     * Return associated AnalyticTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function analyticTypes()
    {
        return $this->belongsTo('App\Models\AnalyticTypes', 'analytic_type_id');
    }
}
