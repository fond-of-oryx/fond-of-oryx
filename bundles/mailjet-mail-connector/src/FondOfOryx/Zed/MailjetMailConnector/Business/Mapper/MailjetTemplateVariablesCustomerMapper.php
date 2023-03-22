<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class MailjetTemplateVariablesCustomerMapper implements MailjetTemplateVariablesTransferMapperInterface
{
    /**
     * @var string
     */
    public const FIRST_NAME = 'firstName';

    /**
     * @var string
     */
    public const LAST_NAME = 'lastName';

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $transfer
     *
     * @return array<string, mixed>
     */
    public function map(AbstractTransfer $transfer): array
    {
        return [
            static::FIRST_NAME => $transfer->getFirstName(),
            static::LAST_NAME => $transfer->getLastName(),
        ];
    }
}
