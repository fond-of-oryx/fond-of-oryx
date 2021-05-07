<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepositoryInterface;

class CustomerReader implements CustomerReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepositoryInterface
     */
    public function __construct(ReturnLabelsRestApiCustomerConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CustomerTransfer
    {
        $idCustomer = $restReturnLabelRequestTransfer->getCustomer()->getIdCustomer();

        if ($idCustomer === null) {
            return null;
        }

        return $this->repository->getCustomerById($idCustomer);
    }
}
