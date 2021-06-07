<?php

namespace FondOfOryx\Zed\SplittableQuote\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Calculation\Business\CalculationFacadeInterface;

class SplittableQuoteToCalculationFacadeBridge implements SplittableQuoteToCalculationFacadeInterface
{
    /**
     * @var \Spryker\Zed\Calculation\Business\CalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @param \Spryker\Zed\Calculation\Business\CalculationFacadeInterface $calculationFacade
     */
    public function __construct(CalculationFacadeInterface $calculationFacade)
    {
        $this->calculationFacade = $calculationFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param bool $executeQuotePlugins
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function recalculateQuote(QuoteTransfer $quoteTransfer, bool $executeQuotePlugins = true): QuoteTransfer
    {
        return $this->calculationFacade->recalculateQuote($quoteTransfer, $executeQuotePlugins);
    }
}
