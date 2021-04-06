<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service;

interface JellyfishAvailabilityAlertToUtilEncodingServiceInterface
{
    /**
     * Specification:
     * - Decodes given JSON string, returns array or stdObject.
     *
     * @api
     *
     * @param string $jsonValue
     * @param bool $assoc
     * @param int|null $depth
     * @param int|null $options
     *
     * @return mixed|null
     */
    public function decodeJson(string $jsonValue, bool $assoc = false, ?int $depth = null, ?int $options = null);

    /**
     * Specification:
     * - Encodes given value to JSON string.
     *
     * @api
     *
     * @param array $value
     * @param int|null $options
     * @param int|null $depth
     *
     * @return string|null
     */
    public function encodeJson(array $value, ?int $options = null, ?int $depth = null);
}
