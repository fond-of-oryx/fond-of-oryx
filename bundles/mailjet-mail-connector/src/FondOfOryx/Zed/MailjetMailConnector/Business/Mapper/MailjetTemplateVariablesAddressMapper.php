<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class MailjetTemplateVariablesAddressMapper implements MailjetTemplateVariablesTransferMapperInterface
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
     * @param \Generated\Shared\Transfer\AddressTransfer $transfer
     *
     * @return array<string, mixed>
     */
    public function map(AbstractTransfer $transfer): array
    {
        return [
            static::COMPANY => $transfer->getCompany(),
            static::FIRST_NAME => $transfer->getFirstName(),
            static::LAST_NAME => $transfer->getLastName(),
            static::EMAIL => $transfer->getEmail(),
            static::ADDRESS1 => $transfer->getAddress1(),
            static::ADDRESS2 => $transfer->getAddress2(),
            static::ADDRESS3 => $transfer->getAddress3(),
            static::ZIP_CODE => $transfer->getZipCode(),
            static::CITY => $transfer->getCity(),
            static::ISO2CODE => $transfer->getIso2Code(),
            static::REGION => $transfer->getRegion(),
        ];
    }
}
