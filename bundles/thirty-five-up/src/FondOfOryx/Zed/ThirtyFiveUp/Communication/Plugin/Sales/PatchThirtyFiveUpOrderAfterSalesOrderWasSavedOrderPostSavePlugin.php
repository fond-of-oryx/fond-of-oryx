<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * Class UpdateThirtyFiveUpOrderAfterPostSaveOrderExpanderPlugin
 *
 * @package FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales
 *
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 */
class PatchThirtyFiveUpOrderAfterSalesOrderWasSavedOrderPostSavePlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        $thirtyFiveUpOrder = $quoteTransfer->getThirtyFiveUpOrder();
        if ($thirtyFiveUpOrder !== null) {
            $this->getFacade()->addAndSaveOrderDataFromSaveOrderTransfer($saveOrderTransfer, $thirtyFiveUpOrder);
        }

        return $saveOrderTransfer;
    }
}
