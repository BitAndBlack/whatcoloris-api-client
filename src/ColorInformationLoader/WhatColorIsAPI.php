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
use WhatColorIs\APIClient\Exception\RequestErrorException;

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
     * @return array{
     *     systems: array<int, array{
     *         system: string,
     *         prefix: string,
     *         suffix: string,
     *     }>
     * }
     * @throws APIKeyMissingException
     * @throws RequestErrorException
     */
    public function requestColorSystem(ColorSystem $colorSystem): array
    {
        $uri = self::getURI().'/'.$colorSystem->getValue();

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
             *     payload: array{
             *         systems: array<int, array{
             *             system: string,
             *             prefix: string,
             *             suffix: string,
             *         }>
             *     }
             * } $restAPIResponse
             */
            $restAPIResponse = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|JsonException $exception) {
            throw new RequestErrorException($exception);
        }

        return $restAPIResponse['payload'];
    }
    
    /**
     * @param ColorSystem $colorSystem
     * @param string $colorName
     * @return array{
     *     name_short: string,
     *     name_full: string,
     *     systems: array<int, string>,
     *     prefix: string,
     *     suffix: string,
     *     values: array<string, array<string|int, int|float|string>>
     * }
     * @throws APIKeyMissingException
     * @throws RequestErrorException
     */
    public function requestColorValue(ColorSystem $colorSystem, string $colorName): array
    {
        $uri = self::getURI().'/'.$colorSystem->getValue();

        $colorNameSlug = urlencode(strtolower($colorName));
        $uri .= '/'.$colorNameSlug;

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
             *     payload: array{
             *         name_short: string,
             *         name_full: string,
             *         systems: array<int, string>,
             *         prefix: string,
             *         suffix: string,
             *         values: array<string, array<string|int, int|float|string>>
             *     }
             * } $restAPIResponse
             */
            $restAPIResponse = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|JsonException $exception) {
            throw new RequestErrorException($exception);
        }

        return $restAPIResponse['payload'];
    }
}