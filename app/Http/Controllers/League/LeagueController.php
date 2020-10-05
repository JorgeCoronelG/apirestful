<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Http\Requests\League\StoreLeagueRequest;
use App\Http\Requests\League\UpdateLeagueRequest;
use App\Http\Resources\League\LeagueCollection;
use App\Http\Resources\League\LeagueResource;
use App\Http\Service\League\LeagueService;
use App\Models\League;

/**
 * Class LeagueController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\League
 * Created 03/10/2020
 */
class LeagueController extends Controller
{
    protected $league;
    private $leagueService;

    /**
     * LeagueController constructor.
     *
     * @param League $league
     */
    public function __construct(League $league)
    {
        $this->league = $league;
        $this->leagueService = new LeagueService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new LeagueCollection($this->league->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeagueRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLeagueRequest $request)
    {
        $this->leagueService->storeLeague($request->all());
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param League $league
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(League $league)
    {
        return response()->json(new LeagueResource($league));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeagueRequest $request
     * @param League $league
     */
    public function update(UpdateLeagueRequest $request, League $league)
    {
        $league->update($request->all());
        return response()->json(new LeagueResource($league), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param League $league
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(League $league)
    {
        $this->leagueService->deleteLeague($league);
        return response()->json(null, 204);
    }
}
