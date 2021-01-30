<?php

namespace App\Util;

/**
 * Class Constants
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Utils
 * Created 27/10/2020
 */
class Constants
{
    // Order by
    const ORDER_BY_QUERY_PARAM_KEY = 'sort';
    const ORDER_BY_ASC = 'ASC';
    const ORDER_BY_DESC = 'DESC';

    // Pagination
    const PAGINATION_QUERY_PARAM_KEY = 'per_page';
    const PAGINATION_ITEMS_DEFAULT = 5;

    // Formulario
    const SIZE_IMG_USER = 10240;

    // Path files
    const PATH_STORAGE = 'storage\\';
    const PATH_STORAGE_PUBLIC = 'public\\';
    const PATH_USER_IMAGES = 'users_images\\';
    const PATH_RULES_FILES = 'rules_files\\';
    const PATH_GAME_FILES = 'game_files\\';

    // Géneros
    const MALE_NAME_KEY = 'male';
    const FEMALE_NAME_KEY = 'female';

    // Formatos
    const FORMAT_PHONE = '###-###-####';
    const FORMAT_DATE_YMD = 'Y-m-d';

    // Medidas
    const IMAGE_HEIGHT = 512;
    const IMAGE_NAME_LENGHT = 40;

    // Expresiones regulares
    const REGULAR_EXPRESSION_PHONE = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';

    // Times something is executed
    const TIMES_TO_RESEND_EMAIL = 5;

    // Sleep
    const SLEEP_TO_RESEND_EMAIL = 100;
}
