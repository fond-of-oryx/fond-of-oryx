<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\Event\Listener;

use FondOfOryx\Shared\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConstants;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiFacadeInterface getFacade()
 */
class CompanyUsersBulkRestApiCompanyUserCreatorListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        if (
            !($transfer instanceof RestCompanyUsersBulkItemCollectionTransfer)
            || $eventName !== CompanyUsersBulkRestApiConstants::BULK_ASSIGN
        ) {
            return;
        }

        $this->getFacade()->createCompanyUserBulkMode($transfer);
    }
}
