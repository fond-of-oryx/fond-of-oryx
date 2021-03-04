<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service;

interface ErpOrderPageSearchToUtilEncodingServiceInterface
{
    /**
     * @param mixed $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string
     */
    public function encodeJson($value, ?int $options = null, ?int $depth = null): string;

    /**
     * @param string $jsonValue
     * @param bool $assoc
     * @param int|null $depth
     * @param int|null $options
     *
     * @return array
     */
    public function decodeJson(string $jsonValue, bool $assoc = false, ?int $depth = null, ?int $options = null): array;
}
