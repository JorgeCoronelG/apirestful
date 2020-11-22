<?php

namespace App\Http\Requests\Notice;

use App\Models\League;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NoticeRequest
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Requests\Notice
 * Created 22/11/2020
 */
class NoticeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:120',
            'description' => 'required|max:255',
            'publish_at' => 'required|date_format:Y-m-d',
            'league_id' => 'required|exists:'.League::class.',id'
        ];
    }
}
