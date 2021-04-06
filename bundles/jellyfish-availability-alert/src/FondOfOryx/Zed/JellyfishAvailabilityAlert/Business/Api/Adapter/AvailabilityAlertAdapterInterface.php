<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter;

use Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer;
use Psr\Http\Message\StreamInterface;

interface AvailabilityAlertAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer): ?StreamInterface;
}
