<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface
     */
    protected BusinessOnBehalfProductListConnectorRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface $repository
     */
    public function __construct(
        BusinessOnBehalfProductListConnectorRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getIdByQuote(QuoteTransfer $quoteTransfer): ?int
    {
        $companyUserReference = $quoteTransfer->getCompanyUserReference();

        if ($companyUserReference === null) {
            return null;
        }

        return $this->repository->getIdCompanyUserByCompanyUserReference($companyUserReference);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getDefaultIdByQuote(QuoteTransfer $quoteTransfer): ?int
    {
        $customerReference = $quoteTransfer->getCustomerReference();

        if ($customerReference === null) {
            return null;
        }

        return $this->repository->getDefaultIdCompanyUserByCustomerReference($customerReference);
    }
}
