<?php

namespace AntonAm\Telegraph\Entities;

/**
 * Class PageList
 *
 * @package  AntonAm\Telegraph\Entities
 * @url https://telegra.ph/api#PageList
 */
class PageList extends Base
{
    public int $total_count = 0;
    public array $pages = [];
}