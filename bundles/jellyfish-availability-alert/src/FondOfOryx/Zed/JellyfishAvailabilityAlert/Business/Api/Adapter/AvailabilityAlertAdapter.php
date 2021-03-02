<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter;

use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface;
use FondOfSpryker\Zed\Jellyfish\Business\Api\Adapter\AbstractAdapter as FondOfSprykerJellyfishAbstractAdapter;
use FondOfSpryker\Zed\Jellyfish\JellyfishConfig;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class AvailabilityAlertAdapter extends FondOfSprykerJellyfishAbstractAdapter implements AvailabilityAlertAdapterInterface
{
    protected const URI = 'standard/availability-alert';

    /**
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfSpryker\Zed\Jellyfish\JellyfishConfig $config
     */
    public function __construct(
        JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService,
        ClientInterface $client,
        JellyfishConfig $config
    ) {
        $this->utilEncodingService = $utilEncodingService;
        $this->client = $client;

        $this->config = $config;
        $this->username = $config->getUsername();
        $this->password = $config->getPassword();
        $this->dryRun = $config->dryRun();
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', rtrim($this->config->getBaseUri(), '/'), static::URI);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void
    {
    }
}
