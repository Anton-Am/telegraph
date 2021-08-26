<?php

namespace AntonAm\Telegraph\Entities;

/**
 * Class Account
 *
 * @package  AntonAm\Telegraph\Entities
 * @url https://telegra.ph/api#Account
 */
class Account extends Base
{
    public $short_name;
    public $author_name;
    public $author_url;
    public $access_token;
    public $auth_url;
    public $page_count;
}