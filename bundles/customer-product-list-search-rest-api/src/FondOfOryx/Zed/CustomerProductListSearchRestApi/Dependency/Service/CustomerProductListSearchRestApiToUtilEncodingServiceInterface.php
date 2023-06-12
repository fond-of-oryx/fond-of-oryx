<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service;

interface CustomerProductListSearchRestApiToUtilEncodingServiceInterface
{
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
    ): string;
}
