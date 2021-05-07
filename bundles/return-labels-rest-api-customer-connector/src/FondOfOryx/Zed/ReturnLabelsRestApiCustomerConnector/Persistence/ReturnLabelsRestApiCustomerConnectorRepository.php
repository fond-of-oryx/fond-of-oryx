<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCustomerConnectorRepository extends AbstractRepository
    implements ReturnLabelsRestApiCustomerConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomerById(int $idCustomer): ?CustomerTransfer
    {
        $spyCustomerQuery = $this->getFactory()
            ->getCustomerQuery()
            ->clear();

        $spyCustomer = $spyCustomerQuery
            ->findOneByIdCustomer($idCustomer);

        if ($spyCustomer === null) {
            return null;
        }

        return $this->getFactory()->createCustomerTransferMapper()
            ->mapEntityToTransfer($spyCustomer, new CustomerTransfer());
    }
}
