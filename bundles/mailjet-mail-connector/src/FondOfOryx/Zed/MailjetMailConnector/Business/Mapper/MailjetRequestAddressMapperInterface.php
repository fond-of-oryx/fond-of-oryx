<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Generated\Shared\Transfer\AddressTransfer;

interface MailjetRequestAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array<string, mixed>
     */
    public function addressTransferToArray(AddressTransfer $addressTransfer): array;
}
