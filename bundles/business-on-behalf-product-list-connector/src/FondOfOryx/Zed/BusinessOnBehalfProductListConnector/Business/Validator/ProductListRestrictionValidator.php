<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

class ProductListRestrictionValidator implements ProductListRestrictionValidatorInterface
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
     * @inheritDoc
     */
    public function validate(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        $quoteTransfer = $cartChangeTransfer->getQuote();

        if ($quoteTransfer === null) {
            return (new CartPreCheckResponseTransfer())->setIsSuccess(false);
        }

        $this->companyUserWriter->setDefaultByQuote($quoteTransfer);

        $quoteTransfer = $this->quoteExpander->expand($quoteTransfer);
        $cartChangeTransfer->setQuote($quoteTransfer);

        return $this->productListFacade->validateItemAddProductListRestrictions($cartChangeTransfer);
    }
}
