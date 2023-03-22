<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface MailjetTemplateVariablesTransferMapperInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return array<string, mixed>
     */
    public function map(AbstractTransfer $transfer): array;
}
