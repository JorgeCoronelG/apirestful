<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmailUserRequest
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Requests\User
 * Created 29/10/2020
 */
class EmailUserRequest extends FormRequest
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
            'email' => 'required|email|max:120'
        ];
    }
}
