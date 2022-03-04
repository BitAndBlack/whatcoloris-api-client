<?php

/**
 * WhatColorIs API Client.
 *
 * @author Tobias Köngeter
 * @copyright Copyright © Bit&Black
 * @link https://www.bitandblack.com
 * @license MIT
 */

namespace WhatColorIs\APIClient\ColorInformationLoader;

use WhatColorIs\APIClient\Enum\ColorSystem;
use WhatColorIs\APIClient\Exception\APIKeyMissingException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * Class WhatColorIsAPI.
 */
class WhatColorIsAPI implements ColorInformationLoaderInterface
{
    private static string $uri = 'https://www.whatcolor.is';

    private static ?string $apiKey = null;
    
    private ClientInterface $client;

    /**
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * @return array<string, mixed>
     */
    public function __serialize(): array
    {
        $client = get_class($this->client);
        $isGuzzleClient = Client::class === $client;
        
        return [
            'c' => $isGuzzleClient ? null : $client,
        ];
    }

    /**
     * @param array<string, mixed> $data
     */
    public function __unserialize(array $data): void
    {
        $client = $data['c'];
        $this->client = $client instanceof ClientInterface ? $client : new Client();
    }

    /**
     * @return string
     */
    public static function getURI(): string
    {
        return self::$uri;
    }

    /**
     * @param string $apiKey
     */
    public static function setApiKey(string $apiKey): void
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @param ColorSystem $colorSystem
     * @param string|null $colorName
     * @return array<mixed>
     * @throws APIKeyMissingException
     */
    public function request(ColorSystem $colorSystem, string $colorName = null): array
    {
        $uri = self::getURI().'/'.$colorSystem->getValue();

        if (null !== $colorName) {
            $colorNameSlug = urlencode(strtolower($colorName));
            $uri .= '/'.$colorNameSlug;
        }

        $uri .= '.json';
        
        $apiToken = self::$apiKey;
        
        if (null === $apiToken) {
            throw new APIKeyMissingException();
        }
        
        $query = http_build_query([
            'token' => $apiToken,
        ]);

        $uri .= '?'.$query;

        try {
            $guzzleResponse = $this->client->request('GET', $uri);
            $responseBody = $guzzleResponse->getBody()->getContents();
            /**
             * @var array{
             *     payload: array<mixed>
             * } $response
             */
            $response = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|JsonException $exception) {
            echo $exception;
            return [];
        }

        if (200 !== $guzzleResponse->getStatusCode()) {
            return [];
        }

        return $response['payload'];
    }
}