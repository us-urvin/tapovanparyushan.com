<?php

namespace App\Constants;

use Symfony\Component\HttpFoundation\Response;

/**
 * HTTP Headers based on IANA Message Headers Registry and Wikipedia list.
 *
 * Class Constants
 */
final class Constants extends Response
{
    /*
    |--------------------------------------------------------------------------
    | HTTP Code
    |--------------------------------------------------------------------------
    */

    /**
     * @var int
     */
    public const HTTP_OK = Response::HTTP_OK;

    /**
     * @var int
     */
    public const HTTP_ACCEPTED = Response::HTTP_ACCEPTED;

    /**
     * @var int
     */
    public const HTTP_CREATED = Response::HTTP_CREATED;

    /**
     * @var int
     */
    public const HTTP_NO_CONTENT = Response::HTTP_NO_CONTENT;

    /**
     * @var int
     */
    public const HTTP_FOUND = Response::HTTP_FOUND;

    /**
     * @var int
     */
    public const HTTP_TEMPORARY_REDIRECT = Response::HTTP_TEMPORARY_REDIRECT;

    /**
     * @var int
     *          RFC7238
     */
    public const HTTP_PERMANENTLY_REDIRECT = Response::HTTP_PERMANENTLY_REDIRECT;

    /**
     * @var int
     */
    public const HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;

    /**
     * @var int
     */
    public const HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;

    /**
     * @var int
     */
    public const HTTP_FORBIDDEN = Response::HTTP_FORBIDDEN;

    /**
     * @var int
     */
    public const HTTP_NOT_FOUND = Response::HTTP_NOT_FOUND;

    /**
     * @var int
     */
    public const HTTP_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED;

    /**
     * @var int
     */
    public const HTTP_REQUEST_TIMEOUT = Response::HTTP_REQUEST_TIMEOUT;

    /**
     * @var int
     */
    public const HTTP_UNSUPPORTED_MEDIA_TYPE = Response::HTTP_UNSUPPORTED_MEDIA_TYPE;

    /**
     * @var int
     *          RFC4918
     */
    public const HTTP_UNPROCESSABLE_ENTITY = Response::HTTP_UNPROCESSABLE_ENTITY;

    /**
     * @var int
     *          RFC4918
     */
    public const HTTP_LOCKED = Response::HTTP_LOCKED;

    /**
     * @var int
     *          RFC2817
     */
    public const HTTP_UPGRADE_REQUIRED = Response::HTTP_UPGRADE_REQUIRED;

    /**
     * @var int
     *          RFC6585
     */
    public const HTTP_TOO_MANY_REQUESTS = Response::HTTP_TOO_MANY_REQUESTS;

    /**
     * @var int
     */
    public const HTTP_INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var int
     */
    public const HTTP_NOT_IMPLEMENTED = Response::HTTP_NOT_IMPLEMENTED;

    /**
     * @var int
     */
    public const HTTP_BAD_GATEWAY = Response::HTTP_BAD_GATEWAY;

    /**
     * @var int
     */
    public const HTTP_SERVICE_UNAVAILABLE = Response::HTTP_SERVICE_UNAVAILABLE;

    /**
     * @var int
     */
    public const HTTP_GATEWAY_TIMEOUT = Response::HTTP_GATEWAY_TIMEOUT;

    /**
     * @var int
     */
    public const HTTP_VERSION_NOT_SUPPORTED = Response::HTTP_VERSION_NOT_SUPPORTED;

    /**
     * @var int
     *          RFC4918
     */
    public const HTTP_INSUFFICIENT_STORAGE = Response::HTTP_INSUFFICIENT_STORAGE;

    /**
     * @var int
     *          RFC5842
     */
    public const HTTP_LOOP_DETECTED = Response::HTTP_LOOP_DETECTED;

    /**
     * @var int
     *          RFC6585
     */
    public const HTTP_NETWORK_AUTHENTICATION_REQUIRED = Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED;

    /*
    |--------------------------------------------------------------------------
    | Entity Status
    |--------------------------------------------------------------------------
    */

    /**
     * @var string
     */
    public const STATUS_ACTIVE = 'active';

    /**
     * @var string
     */
    public const STATUS_INACTIVE = 'inactive';

    /**
     * @var string
     */
    public const STATUS_ALL = 'all';

    /**
     * @var null
     */
    public const STATUS_NULL = null;

    /*
    |--------------------------------------------------------------------------
    | Typographical Symbols
    |--------------------------------------------------------------------------
    */

    /**
     * @var string
     */
    public const BACK_SLASH = '\\';

    /**
     * @var string
     */
    public const SLASH = '/';

    /**
     * @var string
     */
    public const UNDERSCORE = '_';

    /**
     * @var string
     */
    public const HYPHEN = '-';

    /**
     * @var string
     */
    public const AT_SIGN = '@';

    /**
     * @var string
     */
    public const SPACE_BETWEEN = ' ';

    /*
    |--------------------------------------------------------------------------
    | File and Directory Modes
    |--------------------------------------------------------------------------
    */

    /**
     * @var int
     */
    public const FILE_READ_MODE = 0644;

    /**
     * @var int
     */
    public const FILE_WRITE_MODE = 0644;

    /**
     * @var int
     */
    public const DIR_READ_MODE = 0755;

    /**
     * @var int
     */
    public const DIR_WRITE_MODE = 0755;

    /*
    |--------------------------------------------------------------------------
    | General Status Code
    |--------------------------------------------------------------------------
    */

    /**
     * @var int
     */
    public const STATUS_ZERO = 0;

    /**
     * @var int
     */
    public const STATUS_ONE = 1;

    /**
     * @var int
     */
    public const STATUS_TWO = 2;

    /**
     * @var int
     */
    public const STATUS_THREE = 3;

    /**
     * @var int
     */
    public const STATUS_FOUR = 4;

    /**
     * @var int
     */
    public const STATUS_FIVE = 5;

    /**
     * @var int
     */
    public const STATUS_SIX = 6;

    /**
     * @var int
     */
    public const STATUS_SEVEN = 7;

    /**
     * @var int
     */
    public const STATUS_EIGHT = 8;

    /**
     * @var int
     */
    public const STATUS_NINE = 9;

    /**
     * @var bool
     */
    public const STATUS_TRUE = true;

    /**
     * @var bool
     */
    public const STATUS_FALSE = false;

    /**
     * @var array
     */
    public const BLANK_ARRAY = [];

    /*
    |--------------------------------------------------------------------------
    | PAGINATION CONSTANTS
    |--------------------------------------------------------------------------
    */

    /**
     * @var int
     */
    public const PAGINATION_LIMIT = 10;

    public const PAGINATION_START = 1;

    /*
    |--------------------------------------------------------------------------
    | COMMON CONSTANTS
    |--------------------------------------------------------------------------
    */

    public const PHONE_NUMBER_LIMIT = 16;

    public const TOKEN_LIMIT = 64;

    public const HUNDRED = 100;

    /**
     * @var string
     */
    public const BLANK_STRING = '';

    public const FLOAT_VALUE = 0.00;

    public const DASH = '-';

    /*
    |--------------------------------------------------------------------------
    | Error Codes
    |--------------------------------------------------------------------------
    */

    public const CODE_200 = 200;

    public const CODE_401 = 401;

    public const CODE_403 = 403;

    public const CODE_404 = 404;

    public const CODE_422 = 422;

    public const CODE_500 = 500;

    public const CODE_409 = 409;

    /*
    |--------------------------------------------------------------------------
    | HTTP Verbs
    |--------------------------------------------------------------------------
    */

    /**
     * @var string
     */
    public const HTTP_GET = 'GET';

    /**
     * @var string
     */
    public const HTTP_POST = 'POST';

    /**
     * @var string
     */
    public const HTTP_PATCH = 'PATCH';

    /**
     * @var string
     */
    public const HTTP_PUT = 'PUT';

    /*
    |--------------------------------------------------------------------------
    | Asc / Desc
    |--------------------------------------------------------------------------
    */

    public const STATUS_STRING_ASC = 'asc';

    public const STATUS_STRING_DESC = 'desc';

    /*
    |--------------------------------------------------------------------------
    | Particulars
    |--------------------------------------------------------------------------
    */

    public const PARTICULARS = [
        1 => 'Sthankavashi',
        2 => 'Terapanthi',
        3 => 'Digambar'
    ];

    public const SANGH_TYPE = [
        1 => 'Type 1',
        2 => 'Type 2',
    ];
}
