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
    public string $short_name;
    public ?string $author_name = null;
    public ?string $author_url = null;
    public ?string $access_token = null;
    public ?string $auth_url = null;
    public int $page_count = 0;
}