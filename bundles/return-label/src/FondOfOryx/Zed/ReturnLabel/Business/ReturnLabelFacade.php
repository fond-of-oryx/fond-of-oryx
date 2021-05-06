<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory getFactory()
 */
class ReturnLabelFacade extends AbstractFacade implements ReturnLabelFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer {
        return $this->getFactory()
            ->createReturnLabelGenerator()
            ->generate($returnLabelRequestTransfer);
    }
}
