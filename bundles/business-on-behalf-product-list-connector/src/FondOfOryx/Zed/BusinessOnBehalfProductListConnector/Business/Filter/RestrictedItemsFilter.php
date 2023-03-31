<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class RestrictedItemsFilter implements RestrictedItemsFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface
     */
    protected CompanyUserWriterInterface $companyUserWriter;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface
     */
    protected QuoteExpanderInterface $quoteExpander;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface
     */
    protected BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacade;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface $companyUserWriter
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface $quoteExpander
     * @param \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacade
     */
    public function __construct(
        CompanyUserWriterInterface $companyUserWriter,
        QuoteExpanderInterface $quoteExpander,
        BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacade
    ) {
        $this->companyUserWriter = $companyUserWriter;
        $this->quoteExpander = $quoteExpander;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function filter(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $this->companyUserWriter->setDefaultByQuote($quoteTransfer);

        $quoteTransfer = $this->quoteExpander->expand($quoteTransfer);

        return $this->productListFacade->filterRestrictedItems($quoteTransfer);
    }
}
