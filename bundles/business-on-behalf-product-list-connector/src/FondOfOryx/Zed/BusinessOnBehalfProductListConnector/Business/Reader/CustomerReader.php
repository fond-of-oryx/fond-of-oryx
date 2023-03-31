<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CustomerReader implements CustomerReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface
     */
    protected BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacade;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface
     */
    protected BusinessOnBehalfProductListConnectorRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface $repository
     */
    public function __construct(
        BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacade,
        BusinessOnBehalfProductListConnectorRepositoryInterface $repository
    ) {
        $this->customerFacade = $customerFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getByQuote(QuoteTransfer $quoteTransfer): ?CustomerTransfer
    {
        $idCustomer = $this->getIdByQuote($quoteTransfer);

        if ($idCustomer === null) {
            return null;
        }

        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer($idCustomer);

        return $this->customerFacade->findCustomerById($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getIdByQuote(QuoteTransfer $quoteTransfer): ?int
    {
        $customerReference = $quoteTransfer->getCustomerReference();

        if ($customerReference === null) {
            return null;
        }

        return $this->repository->getIdCustomerByCustomerReference($customerReference);
    }
}
