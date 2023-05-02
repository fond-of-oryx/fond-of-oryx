<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface RepresentativeCompanyUserToEventFacadeInterface
{
    /**
     * @param string $eventName
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     *
     * @return void
     */
    public function trigger(string $eventName, TransferInterface $transfer);
}
