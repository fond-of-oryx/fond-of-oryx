<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Generated\Shared\Transfer\AddressTransfer;

class MailjetRequestAddressMapper implements MailjetRequestAddressMapperInterface
{
    /**
     * @var string
     */
    public const COMPANY = 'company';

    /**
     * @var string
     */
    public const FIRST_NAME = 'firstName';

    /**
     * @var string
     */
    public const LAST_NAME = 'lastName';

    /**
     * @var string
     */
    public const EMAIL = 'email';

    /**
     * @var string
     */
    public const ADDRESS1 = 'address1';

    /**
     * @var string
     */
    public const ADDRESS2 = 'address2';

    /**
     * @var string
     */
    public const ADDRESS3 = 'address3';

    /**
     * @var string
     */
    public const ZIP_CODE = 'zipCode';

    /**
     * @var string
     */
    public const CITY = 'city';

    /**
     * @var string
     */
    public const ISO2CODE = 'iso2code';

    /**
     * @var string
     */
    public const REGION = 'region';

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array<mixed>
     */
    public function addressTransferToArray(AddressTransfer $addressTransfer): array
    {
        return [
            static::COMPANY => $addressTransfer->getCompany(),
            static::FIRST_NAME => $addressTransfer->getFirstName(),
            static::LAST_NAME => $addressTransfer->getLastName(),
            static::EMAIL => $addressTransfer->getEmail(),
            static::ADDRESS1 => $addressTransfer->getAddress1(),
            static::ADDRESS2 => $addressTransfer->getAddress2(),
            static::ADDRESS3 => $addressTransfer->getAddress3(),
            static::ZIP_CODE => $addressTransfer->getZipCode(),
            static::CITY => $addressTransfer->getCity(),
            static::ISO2CODE => $addressTransfer->getIso2Code(),
            static::REGION => $addressTransfer->getRegion(),
        ];
    }
}
