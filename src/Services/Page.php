<?php

namespace AntonAm\Telegraph\Services;

use AntonAm\Telegraph\Entities\Node;
use AntonAm\Telegraph\Exceptions\PageException;
use AntonAm\Telegraph\Entities\Page as PageEntity;
use AntonAm\Telegraph\Entities\PageViews as PageViewsEntity;

/**
 * Class Page
 *
 * @package  AntonAm\Telegraph\Services
 */
class Page extends Base
{
    private ?string $title = null;
    private ?string $authorName = null;
    private ?string $authorUrl = null;
    private ?array $content = [];

    public function get(): PageEntity
    {
        if (empty($this->entity)) {
            throw new PageException('Path is required');
        }

        $data = [
            'path'           => $this->entity,
            'return_content' => true
        ];

        $pageEntity = new PageEntity($this->manager->handleRequest('/getPage', $data));
        $pageEntity->setAccount($this->manager->account()->get());

        return $pageEntity;
    }

    public function statistic(int $year = null, int $month = null, int $day = null, int $hour = null): PageViewsEntity
    {
        $data = array_filter([
            'path'  => $this->entity,
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
            'hour'  => $hour
        ]);

        return new PageViewsEntity($this->manager->handleRequest('/getViews', $data));
    }

    public function create(): PageEntity
    {
        $account = null;
        if (!$this->manager->hasToken()) {
            $account = $this->manager->account()->create();
            $this->manager->setToken($account);
        }

        if (empty($this->title) || empty($this->content)) {
            throw new PageException('Title and content fields are required');
        }

        $data = array_filter([
            'title'          => $this->title,
            'author_name'    => $this->authorName,
            'author_url'     => $this->authorUrl,
            'content'        => $this->content,
            'return_content' => true
        ]);

        $pageEntity = new PageEntity($this->manager->handleRequest('/createPage', $data));
        $pageEntity->setAccount($account);

        return $pageEntity;
    }

    public function edit(): PageEntity
    {
        if (empty($this->entity) || empty($this->title) || empty($this->content)) {
            throw new PageException('Path, title and content fields are required');
        }


        $data = array_filter([
            'path'           => $this->entity,
            'title'          => $this->title,
            'author_name'    => $this->authorName,
            'author_url'     => $this->authorUrl,
            'content'        => $this->content,
            'return_content' => true
        ]);

        return new PageEntity($this->manager->handleRequest('/editPage', $data));
    }

    public function setAuthor(string $name = null, string $url = null): self
    {
        if (!empty($name)) {
            $this->authorName = $name;
        }

        if (!empty($url)) {
            $this->authorUrl = $url;
        }

        if ((empty($name) || empty($url)) && $this->manager->hasToken()) {
            $author = $this->manager->account()->get();

            if (empty($name) && !empty($author->author_name)) {
                $this->authorName = $author->author_name;
            }

            if (empty($name) && !empty($author->author_name)) {
                $this->authorUrl = $author->author_url;
            }
        }
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function addLink(string $text, string $href): self
    {
        $this->addHtml('a', $text, ['href' => $href]);
        return $this;
    }

    public function addText(string $text): self
    {
        $this->addHtml('p', $text);
        return $this;
    }

    public function addHtml(string $tag, string $text = null, array $attrs = null): self
    {
        $node = new Node([
            'tag'      => $tag,
            'attrs'    => $attrs,
            'children' => [$text]
        ]);
        $this->content[] = $node->validate();
        return $this;
    }

    public function addImage(string $src): self
    {
        $this->addHtml('img', null, ['src' => $src]);
        return $this;
    }
}