<?php

namespace App\Http\Requests\League;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreLeagueRequest
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Requests\League
 * Created 03/10/2020
 */
class StoreLeagueRequest extends FormRequest
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
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users|max:120'
        ];
    }
}
