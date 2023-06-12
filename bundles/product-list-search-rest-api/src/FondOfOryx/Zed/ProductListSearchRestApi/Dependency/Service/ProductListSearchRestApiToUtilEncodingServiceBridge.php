<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ProductListSearchRestApiToUtilEncodingServiceBridge implements ProductListSearchRestApiToUtilEncodingServiceInterface
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
     * @param string $jsonValue
     * @param bool $assoc Deprecated: `false` is deprecated, always use `true` for array return.
     * @param int|null $depth
     * @param int|null $options
     *
     * @return object|array|null
     */
    public function decodeJson(
        string $jsonValue,
        bool $assoc = false,
        ?int $depth = null,
        ?int $options = null
    ): object|array|null {
        return $this->utilEncodingService->decodeJson($jsonValue, $assoc, $depth, $options);
    }
}
