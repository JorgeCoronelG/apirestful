<?php

namespace App\Http\Controllers\Notice;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Notice\NoticeRequest;
use App\Http\Resources\Notice\NoticeCollection;
use App\Http\Resources\Notice\NoticeResource;
use App\Models\Notice;
use App\Models\User;
use App\Services\Notice\NoticeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NoticeController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\Notice
 * Created 22/11/2020
 */
class NoticeController extends ApiController
{
    private $notice;
    private $noticeService;

    /**
     * NoticeController constructor.
     *
     * @param Notice $notice
     * @param NoticeService $noticeService
     */
    public function __construct(Notice $notice, NoticeService $noticeService)
    {
        /*$this->middleware('permission:'.
            User::USUARIO_SUPER_ADMINISTRADOR.','.
            User::USUARIO_ADMINISTRADOR)
            ->except(['index']);*/
        $this->notice = $notice;
        $this->noticeService = $noticeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $notices = $this->noticeService->findAll($request);
        return $this->showAll(new NoticeCollection($notices));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NoticeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NoticeRequest $request)
    {
        $notice = $this->notice->create($request->validated());
        return $this->showOne(new NoticeResource($notice), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Notice $notice
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Notice $notice)
    {
        return $this->showOne(new NoticeResource($notice));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NoticeRequest $request
     * @param Notice $notice
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NoticeRequest $request, Notice $notice)
    {
        $notice = $this->noticeService->updateNotice($request->validated(), $notice);
        return $this->showOne(new NoticeResource($notice));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notice $notice
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return $this->noContentResponse();
    }
}
