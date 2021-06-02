<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Sales\Dependency\Plugin\OrderExpanderPreSavePluginInterface;

/**
 * Class ThirtyFiveUpOrderExpanderPlugin
 *
 * @package FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales
 *
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 */
class ThirtyFiveUpOrderExpanderPlugin extends AbstractPlugin implements OrderExpanderPreSavePluginInterface
{
    /**
     * Specification:
     *   - Its a plugin which hydrates SpySalesOrderEntityTransfer before order created
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SpySalesOrderEntityTransfer $spySalesOrderEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    public function expand(
        SpySalesOrderEntityTransfer $spySalesOrderEntityTransfer,
        QuoteTransfer $quoteTransfer
    ): SpySalesOrderEntityTransfer {
        $quoteTransfer = $this->getFacade()->createThirtyFiveUpOrderFromQuote($quoteTransfer);
        $thirtyFiveUpOrder = $quoteTransfer->getThirtyFiveUpOrder();

        if ($thirtyFiveUpOrder !== null) {
            $spySalesOrderEntityTransfer->setFkThirtyFiveUpOrder($thirtyFiveUpOrder->getId());
        }

        return $spySalesOrderEntityTransfer;
    }
}
