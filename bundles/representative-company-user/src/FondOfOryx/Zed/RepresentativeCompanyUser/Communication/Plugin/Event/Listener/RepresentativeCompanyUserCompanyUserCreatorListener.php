<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener;

use Exception;
use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface getFacade()
 */
class RepresentativeCompanyUserCompanyUserCreatorListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param $eventName
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        if (
            !($transfer instanceof RepresentativeCompanyUserTransfer)
            || $eventName !== RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER
        ) {
            return;
        }

        try {
            $this->getFacade()->createCompanyUserForRepresentation($transfer);
            $this->getFacade()->setRepresentationState($transfer->getUuid(), FooRepresentativeCompanyUserTableMap::COL_STATE_ACTIVE);
        } catch (Exception $exception) {
            $this->getFacade()->setRepresentationState($transfer->getUuid(), FooRepresentativeCompanyUserTableMap::COL_STATE_ERROR);

            throw $exception;
        }
    }
}
