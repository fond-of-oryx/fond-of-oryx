<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;

interface MailjetTemplateVariablesTransferCollectionMapperInterface
{
    /**
     * @param \ArrayObject<\Spryker\Shared\Kernel\Transfer\AbstractTransfer> $arrayObject
     *
     * @return array<array<string, mixed>>
     */
    public function transferCollectionToArray(ArrayObject $arrayObject): array;
}
