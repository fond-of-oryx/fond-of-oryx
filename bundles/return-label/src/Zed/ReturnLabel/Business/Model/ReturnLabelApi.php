<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use GuzzleHttp\ClientInterface as HttpClient;
use GuzzleHttp\Exception\ClientException;

class ReturnLabelApi implements ReturnLabelApiInterface
{
    public const METHOD = 'post';

    /**
     * @var ReturnLabelRepositoryInterface
     */
    protected $returnLabelRepository;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var ReturnLabelConfig
     */
    protected $config;

    /**
     * @param ReturnLabelRepositoryInterface $returnLabelRepository
     * @param HttpClient $httpClient
     */
    public function __construct(
        ReturnLabelRepositoryInterface $returnLabelRepository,
        HttpClient $httpClient,
        ReturnLabelConfig $config
    )
    {
        $this->returnLabelRepository = $returnLabelRepository;
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    public function requestReturnLabel()
    {
        try {
            $response = $this->guzzleClient->request(
                static::METHOD,
                $this->config->getReturnLabelMicroServiceUrl(),
                [
                    /*'auth' => [
                        $this->config->get(DhlApiConstants::API_USER),
                        $this->config->get(DhlApiConstants::API_PASS)
                    ],
                    'headers' => $this->getHeaders(),*/
                    'body' => json_encode($dhlApiReturnOrderRequest),
                ]
            );
        } catch (ClientException $exception) {
            return null;
        }
    }
}
