<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface CompaniesRestApiPermissionToZedRequestInterface
{
    /**
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param int|null $timeoutInSeconds
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call(string $url, TransferInterface $object, ?int $timeoutInSeconds = null): TransferInterface;
}
