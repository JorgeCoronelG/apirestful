<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\PhoneNumber;
use App\Util\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Requests\User
 * Created 30/01/2021
 */
class UpdateUserRequest extends FormRequest
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
            'email' => [
                'email:dns',
                'max:120',
                Rule::unique('users', 'email')->ignore($this->user->id, 'id')
            ],
            'complete_name' => 'required|min:4|max:150',
            'phone' => ['required', 'max:12', new PhoneNumber()],
            'photo' => ['image', 'max:'.Constants::SIZE_IMG_USER],
            'birthday' => ['required', 'date_format:'.Constants::FORMAT_DATE_YMD],
            'gender' => ['required', Rule::in([User::USER_MALE, User::USER_FEMALE])]
        ];
    }
}
