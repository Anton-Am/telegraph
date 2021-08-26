<?php

namespace AntonAm\Telegraph\Entities;

/**
 * Class Page
 *
 * @package  AntonAm\Telegraph\Entities
 * @url https://telegra.ph/api#Page
 */
class Page extends Base
{
    public $path;
    public $url;
    public $title;
    public $description;
    public $author_name;
    public $author_url;
    public $image_url;
    public $content;
    public $views;
    public $can_edit;

    public $account;

    public function setAccount(?Account $account): self
    {
        $this->account = $account;
        return $this;
    }
}