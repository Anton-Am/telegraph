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
    public ?string $path = null;
    public ?string $url = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $author_name = null;
    public ?string $author_url = null;
    public ?string $image_url = null;
    public ?array $content = [];
    public int $views = 0;
    public bool $can_edit;

    public ?Account $account = null;

    public function setAccount(?Account $account): self
    {
        $this->account = $account;
        return $this;
    }
}