<?php

namespace App\Rules;

use App\Util\Constants;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class PhoneNumber
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Rules
 * Created 13/12/2020
 */
class PhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match(Constants::REGULAR_EXPRESSION_PHONE, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El formato del campo teléfono debe ser ###-###-####.';
    }
}
