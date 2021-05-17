<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiBusinessFactory getFactory()
 */
class ReturnLabelsRestApiFacade extends AbstractFacade implements ReturnLabelsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        return $this->getFactory()
            ->createReturnLabelGenerator()
            ->generate($restReturnLabelRequestTransfer);
    }
}
