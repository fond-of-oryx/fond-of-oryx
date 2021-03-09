<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutRestApiToCalculationFacadeBridge implements SplittableCheckoutRestApiToCalculationFacadeInterface
{
    /**
     * @var \Spryker\Zed\Calculation\Business\CalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @param \Spryker\Zed\Calculation\Business\CalculationFacadeInterface $calculationFacade
     */
    public function __construct($calculationFacade)
    {
        $this->calculationFacade = $calculationFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function recalculateQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->calculationFacade->recalculateQuote($quoteTransfer);
    }
}
