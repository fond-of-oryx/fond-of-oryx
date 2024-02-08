<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Dependency\Service;

interface CartSearchRestApiToUtilEncodingServiceInterface
{
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
    ): object|array|null;
}
