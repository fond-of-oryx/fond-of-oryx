<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CustomerReader implements CustomerReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface $customerFacade
     */
    public function __construct(ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface $customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CustomerTransfer {
        if ($restReturnLabelRequestTransfer->getCustomer() === null) {
            return null;
        }

        $idCustomer = $restReturnLabelRequestTransfer->getCustomer()->getIdCustomer();

        if ($idCustomer === null) {
            return null;
        }

        return $this->customerFacade->findCustomerById(
            (new CustomerTransfer())->setIdCustomer($idCustomer),
        );
    }
}
