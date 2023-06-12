<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class CustomerProductListSearchRestApiToUtilEncodingServiceBridge implements CustomerProductListSearchRestApiToUtilEncodingServiceInterface
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param array $jsonValue
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string
     */
    public function encodeJson(
        array $jsonValue,
        ?int $options = null,
        ?int $depth = null
    ): string {
        return $this->utilEncodingService->encodeJson($jsonValue, $options, $depth);
    }
}
