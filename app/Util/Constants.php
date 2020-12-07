<?php

namespace App\Util;

/**
 * Class Constants
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Util
 * Created 27/10/2020
 */
class Constants
{
    // ORDER BY
    const ORDER_BY_KEY = 'sort';
    const ORDER_BY_ASC = 'ASC';
    const ORDER_BY_DESC = 'DESC';

    // Pagination
    const PAGINATION_KEY = 'per_page';
    const PAGINATION_DEFAULT = 5;

    // Path files
    const PATH_STORAGE = '/storage/';
    const PATH_USER_IMAGES = 'users_images/';
    const PATH_RULES_FILES = 'rules_files/';
    const PATH_GAME_FILES = 'game_files/';

    // Times something is executed
    const TIMES_TO_RESEND_EMAIL = 5;

    // Sleep
    const SLEEP_TO_RESEND_EMAIL = 100;
}
