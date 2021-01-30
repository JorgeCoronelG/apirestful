<?php

namespace App\Services\Notice;

use App\Models\Notice;
use App\Util\Constants;
use App\Util\Messages;
use App\Util\Utils;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NoticeService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Services\Notice
 * Created 22/11/2020
 */
class NoticeService
{
    /**
     * Función para mostrar los registros
     *
     * @param Request $request
     * @return mixed
     */
    public function findAll(Request $request)
    {
        $filter['title'] = $request->get('title');
        $filter['description'] = $request->get('description');
        $filter['publish_at'] = $request->get('publish_at');
        $filter['league'] = $request->get('league');
        $perPage = Utils::getPerPage($request);
        $sort = Utils::cleanExtraSorts($request->get(Constants::ORDER_BY_KEY));
        return Notice::with('league')
            ->filter($filter)
            ->applySort($sort)
            ->paginate($perPage);
    }

    /**
     * Función para actualizar una noticia
     *
     * @param array $data
     * @param Notice $notice
     * @return Notice
     * @throws \Throwable
     */
    public function updateNotice(array $data, Notice $notice)
    {
        $notice->title = $data['title'];
        $notice->description = $data['description'];
        $notice->publish_at = $data['publish_at'];
        $notice->league_id = $data['league_id'];
        if (!$notice->isDirty()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::MODEL_IS_DIRTY);
        }
        $notice->saveOrFail();
        return $notice;
    }
}
