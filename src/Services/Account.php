<?php

namespace AntonAm\Telegraph\Services;

use AntonAm\Telegraph\Entities\Account as AccountEntity;
use AntonAm\Telegraph\Entities\PageList as PageListEntity;

/**
 * Class Account
 *
 * @package  AntonAm\Telegraph\Services
 */
class Account extends Base
{
    public function get(): AccountEntity
    {
        return new AccountEntity($this->manager->handleRequest('/getAccountInfo'));
    }

    public function create(string $loginName = null, string $publicName = null, string $publicUrl = null): AccountEntity
    {
        $loginName = $loginName ?? uniqid('u', false);

        $data = array_filter([
            'short_name'  => $loginName,
            'author_name' => $publicName,
            'author_url'  => $publicUrl
        ]);

        return new AccountEntity($this->manager->handleRequest('/createAccount', $data, false));
    }

    public function edit(string $loginName = null, string $publicName = null, string $publicUrl = null): AccountEntity
    {
        $loginName = $loginName ?? uniqid('u', false);

        $data = array_filter([
            'short_name'  => $loginName,
            'author_name' => $publicName,
            'author_url'  => $publicUrl
        ]);

        return new AccountEntity($this->manager->handleRequest('/editAccountInfo', $data));
    }

    public function revoke(): AccountEntity
    {
        return new AccountEntity($this->manager->handleRequest('/revokeAccessToken'));
    }

    public function pages(int $offset = 0, int $limit = 50): PageListEntity
    {
        $data = array_filter([
            'offset' => $offset,
            'limit'  => $limit
        ]);
        return new PageListEntity($this->manager->handleRequest('/getPageList', $data));
    }
}