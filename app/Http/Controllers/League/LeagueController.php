<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\ApiController;
use App\Http\Requests\League\StoreLeagueRequest;
use App\Http\Requests\League\UpdateLeagueRequest;
use App\Http\Resources\League\LeagueCollection;
use App\Http\Resources\League\LeagueResource;
use App\Models\League;
use App\Services\League\LeagueService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LeagueController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\League
 * Created 03/10/2020
 */
class LeagueController extends ApiController
{
    private $leagueService;

    /**
     * LeagueController constructor.
     *
     * @param LeagueService $leagueService
     */
    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $leagues = $this->leagueService->findALl($request);
        return $this->showAll(new LeagueCollection($leagues));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeagueRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLeagueRequest $request)
    {
        $league = $this->leagueService->storeLeague($request->validated());
        return $this->showOne(new LeagueResource($league), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param League $league
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(League $league)
    {
        return $this->showOne(new LeagueResource($league));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeagueRequest $request
     * @param League $league
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateLeagueRequest $request, League $league)
    {
        $league = $this->leagueService->updateLeague($request->validated(), $league);
        return $this->showOne(new LeagueResource($league));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param League $league
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        $this->leagueService->deleteLeague($league);
        return $this->noContentResponse();
    }
}
