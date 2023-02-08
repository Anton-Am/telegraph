<?php

namespace AntonAm\Telegraph;

use AntonAm\Telegraph\Entities\Account as AccountEntity;
use AntonAm\Telegraph\Exceptions\TelegraphRequestException;
use AntonAm\Telegraph\Services\Account;
use AntonAm\Telegraph\Services\Page;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * Class Manager
 *
 * @package AntonAm\Telegraph
 */
class Manager
{
    private string $api = 'https://api.telegra.ph/';
    private ?Client $client;
    private string $token;

    public function __construct($telegraphAccountToken = null)
    {
        $this->client = new Client(['base_uri' => $this->api]);
        $this->setToken($telegraphAccountToken);
    }

    public function page(string $path = null): Page
    {
        return new Page($this, $path);
    }

    public function account(): Account
    {
        return new Account($this);
    }

    public function setToken($token = null): self
    {
        if (!empty($token)) {
            if (is_a($token, AccountEntity::class)) {
                $this->token = $token->access_token;
            } elseif (is_string($token)) {
                $this->token = $token;
            }
        }

        return $this;
    }

    public function hasToken(): bool
    {
        return !empty($this->token);
    }

    /**
     * @param string $method
     * @param array $data
     * @param bool $tokenRequired
     * @return mixed
     * @throws TelegraphRequestException
     * @throws JsonException
     * @throws GuzzleException
     */
    public function handleRequest(string $method, array $data = [], bool $tokenRequired = true)
    {
        $requestData['json'] = $data;

        if ($tokenRequired && !$this->hasToken()) {
            throw new TelegraphRequestException("Method {$method} requires access token");
        }

        if ($this->hasToken()) {
            $requestData['json']['access_token'] = $this->token;
        }

        $response = json_decode($this->client->post($method, $requestData)->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (!$response['ok']) {
            throw new TelegraphRequestException($response['error']);
        }

        return $response['result'];
    }
}
