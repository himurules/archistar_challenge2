<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyAnalyticsRequest;
use App\Http\Requests\PropertyRequest;
use App\Http\Resources\AnalyticsSummaryResource;
use App\Http\Resources\AnalyticTypesResource;
use App\Http\Resources\PropertiesResource;
use App\Models\AnalyticTypes;
use App\Models\Properties;
use App\Models\PropertyAnalytics;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class PropertiesController
 *
 * @package App\Http\Controllers
 */
class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $properties = Properties::all();
        return PropertiesResource::collection($properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PropertyRequest $request)
    {
        $requestData = $request->all();
        $requestData['id'] = intval(Properties::max('id')) + 1;
        $property = Properties::create($requestData);
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Properties $properties Property to show
     *
     * @return PropertiesResource
     */
    public function show(Properties $properties)
    {
        return new PropertiesResource($properties);
    }

    /**
     * Update Property analytic
     *
     * @param PropertyAnalyticsRequest $request RequestObject
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAnalytic(PropertyAnalyticsRequest $request)
    {
        $requestData = $request->validated();
        $property = Properties::find($requestData['property_id']);
        $analytic = AnalyticTypes::find($requestData['analytic_type_id']);
        if (!$property || !$analytic) {
            return response()->json('Invalid Request Parameter', 400);
        }
        $propertyAnalytics = PropertyAnalytics::firstOrNew(
            array(
                'property_id'    => $requestData['property_id'],
                'analytic_type_id' => $requestData['analytic_type_id']
            )
        );
        if ($propertyAnalytics->exists) {
            $propertyAnalytics->value = $requestData['value'];
            $propertyAnalytics->save();
        } else {
            PropertyAnalytics::create($requestData);
        }
        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Properties $properties Property to show
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function propertyAnalytics(Properties $properties)
    {
        return AnalyticTypesResource::collection($properties->propertyAnalytics);
    }

    /**
     * Get a summary of all property analytics for an input suburb
     *
     * @param $type String
     * @param $value String
     * @return \Illuminate\Http\JsonResponse
     */
    public function analyticsSummary($type, $value)
    {
        if (!in_array($type, ['country','state','suburb'])) {
            return response()->json('Invalid Request', 400);
        }
        $totalProperties = Properties::where($type, $value)->count();
        $summary = DB::table('analytic_types')
            ->join(
                'property_analytics',
                'analytic_types.id',
                '=',
                'property_analytics.analytic_type_id'
            )
            ->join(
                'properties',
                'properties.id',
                '=',
                'property_analytics.property_id'
            )
            ->where("properties.{$type}", '=', $value)
            ->groupBy('analytic_types.id')
            ->selectRaw(
                'analytic_types.id,analytic_types.name,'
                            ."{$totalProperties} as totalProperties,"
                            .'min(property_analytics.value+0) as minVal,'
                            .'max(property_analytics.value+0) as maxVal,'
                            .'avg(property_analytics.value+0) as median,'
                            ."count(properties.id) as propertiesCount"
            )
            ->get();
        $summaryResource = AnalyticsSummaryResource::collection($summary);
        return response()->json($summaryResource, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Properties $properties
     * @return \Illuminate\Http\Response
     */
    public function edit(Properties $properties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Properties $properties
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Properties $properties)
    {
        $properties->update($request->all());
        return response()->json($properties, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Properties $properties
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Properties $properties)
    {
        $properties->delete();
        return response()->json(null, 204);
    }
}
