<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Persistence;

use Generated\Shared\Transfer\NotificationCustomerCollectionTransfer;

/**
 * @method \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorPersistenceFactory getFactory()
 */
interface CompanyUserMailConnectorRepositoryInterface
{
    /**
     * @param int $fkCompany
     * @param array $roleNames
     * @return \Generated\Shared\Transfer\NotificationCustomerCollectionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function getNotificationCustomerByFkCompanyAndRole(int $fkCompany, array $roleNames): NotificationCustomerCollectionTransfer;
}
