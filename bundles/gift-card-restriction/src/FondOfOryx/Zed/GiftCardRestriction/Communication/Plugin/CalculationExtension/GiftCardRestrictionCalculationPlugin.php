<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\CalculationExtension;

use Generated\Shared\Transfer\CalculableObjectTransfer;
use Spryker\Zed\CalculationExtension\Dependency\Plugin\CalculationPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 * @method \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacadeInterface getFacade()
 */
class GiftCardRestrictionCalculationPlugin extends AbstractPlugin implements CalculationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer): void
    {
        $this->getFacade()->recalculate($calculableObjectTransfer);
    }
}
