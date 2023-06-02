<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface RepresentativeCompanyUserTradeFairToEventFacadeInterface
{
    /**
     * @param string $eventName
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     *
     * @return void
     */
    public function trigger(string $eventName, TransferInterface $transfer);
}
