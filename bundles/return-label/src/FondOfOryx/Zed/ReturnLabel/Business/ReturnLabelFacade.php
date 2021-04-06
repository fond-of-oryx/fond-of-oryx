<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface getRepository()
 */
class ReturnLabelFacade extends AbstractFacade implements ReturnLabelFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer {
        // TODO: Implement generateReturnLabel() method.

        $this->getFactory();
    }
}
