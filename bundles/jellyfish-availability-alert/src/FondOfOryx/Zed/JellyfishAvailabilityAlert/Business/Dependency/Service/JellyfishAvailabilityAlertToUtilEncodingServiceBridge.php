<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class JellyfishAvailabilityAlertToUtilEncodingServiceBridge implements JellyfishAvailabilityAlertToUtilEncodingServiceInterface
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $service;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->service = $utilEncodingService;
    }

    /**
     * @param string $jsonValue
     * @param bool $assoc
     * @param int|null $depth
     * @param int|null $options
     *
     * @return mixed|null
     */
    public function decodeJson($jsonValue, $assoc = false, $depth = null, $options = null)
    {
        return $this->service->decodeJson($jsonValue, $assoc, $depth, $options);
    }

    /**
     * @param array $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string|null
     */
    public function encodeJson($value, $options = null, $depth = null): ?string
    {
        return $this->service->encodeJson($value, $options, $depth);
    }
}
