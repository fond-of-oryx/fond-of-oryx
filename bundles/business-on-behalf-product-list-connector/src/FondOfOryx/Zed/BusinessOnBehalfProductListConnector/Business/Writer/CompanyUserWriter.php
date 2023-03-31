<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CompanyUserWriter implements CompanyUserWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface
     */
    protected CompanyUserReaderInterface $companyUserReader;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface
     */
    protected CustomerReaderInterface $customerReader;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface
     */
    protected BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface $companyUserReader
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface $customerReader
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade
     */
    public function __construct(
        CompanyUserReaderInterface $companyUserReader,
        CustomerReaderInterface $customerReader,
        BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade
    ) {
        $this->companyUserReader = $companyUserReader;
        $this->customerReader = $customerReader;
        $this->businessOnBehalfFacade = $businessOnBehalfFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function setDefaultByQuote(QuoteTransfer $quoteTransfer): void
    {
        $idCompanyUser = $this->companyUserReader->getIdByQuote($quoteTransfer);
        $idCustomer = $this->customerReader->getIdByQuote($quoteTransfer);

        if ($idCompanyUser === null || $idCustomer === null) {
            return;
        }

        $defaultIdCompanyUser = $this->companyUserReader->getDefaultIdByQuote($quoteTransfer);

        if ($idCompanyUser === $defaultIdCompanyUser) {
            return;
        }

        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer($idCustomer);

        $this->businessOnBehalfFacade->unsetDefaultCompanyUserByCustomer($customerTransfer);

        $companyUserTransfer = (new CompanyUserTransfer())
            ->setIdCompanyUser($idCompanyUser)
            ->setFkCustomer($idCustomer)
            ->setCustomer($customerTransfer);

        $this->businessOnBehalfFacade->setDefaultCompanyUser($companyUserTransfer);
    }
}
