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

use Psr\Http\Message\ResponseInterface;
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
    
    private ?ResponseInterface $lastResponse = null;

    /**
     * @param ClientInterface|null $client
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
     * @param ColorSystem $colorSystem Name of the requested color system.
     * @param bool $includeColorValues If all available color values should be included too.
     * @return array{
     *     systems: array<int, array{
     *         system: string,
     *         prefix: string,
     *         suffix: string,
     *     }>,
     *     values?: array<int, array<string, int|float|string>>
     * }
     * @throws APIKeyMissingException
     * @throws RequestErrorException
     */
    public function requestColorSystem(ColorSystem $colorSystem, bool $includeColorValues = false): array
    {
        $uri = $this->buildURI($colorSystem);
        
        if ($includeColorValues) {
            $uri = $this->buildURI($colorSystem, null, ['includeColorValues' => true]);
        }

        $responseBody = $this->request($uri);

        try {
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
        } catch (JsonException $exception) {
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
        $uri = $this->buildURI($colorSystem, $colorName);
        $responseBody = $this->request($uri);
        
        try {
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
        } catch (JsonException $exception) {
            throw new RequestErrorException($exception);
        }

        return $restAPIResponse['payload'];
    }

    /**
     * @param ColorSystem $colorSystem
     * @param string|null $colorName
     * @param array<string, int|float|string|bool> $parameters
     * @return string
     */
    private function buildURI(ColorSystem $colorSystem, string $colorName = null, array $parameters = []): string
    {
        $uri = self::getURI().'/'.$colorSystem->getValue();

        if (null !== $colorName) {
            $colorName = strtolower($colorName);
            $colorNameSlug = urlencode($colorName);
            $uri .= '/'.$colorNameSlug;
        }

        $uri .= '.json';
        
        $query = http_build_query($parameters);

        $uri .= '?'.$query;
        
        return $uri;
    }

    /**
     * @return string[]
     * @throws APIKeyMissingException
     */
    private function getHeaders(): array
    {
        $apiToken = self::$apiKey;

        if (null === $apiToken) {
            throw new APIKeyMissingException();
        }
        
        return [
            'Authorization' => 'Bearer '.$apiToken,
            'Accept' => 'application/json',
        ];
    }

    /**
     * @param string $uri
     * @return string
     * @throws APIKeyMissingException
     * @throws RequestErrorException
     */
    private function request(string $uri): string
    {
        try {
            $guzzleResponse = $this->client->request(
                'GET', 
                $uri, 
                [
                    'headers' => $this->getHeaders()
                ]
            );
            $this->lastResponse = $guzzleResponse;
            return $guzzleResponse->getBody()->getContents();
        } catch (GuzzleException $exception) {
            throw new RequestErrorException($exception);
        }
    }

    /**
     * Returns the last response.
     *
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }
}