<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service;

interface VertigoPriceProductPriceListToUtilEncodingServiceInterface
{
    /**
     * @param array $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string|null
     */
    public function encodeJson(array $value, ?int $options = null, ?int $depth = null): ?string;
}
