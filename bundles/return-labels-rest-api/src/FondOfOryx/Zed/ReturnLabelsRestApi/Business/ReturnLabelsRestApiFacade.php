<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiFacade extends AbstractFacade implements ReturnLabelsRestApiFacadeInterface
{
    /**
     * Specifications:
     * - Create return label
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return void
     */
    public function generateReturnLabel(RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer): void
    {
        return $this->getFactory()->createReturnLabelGenerator()->generate($restReturnLabelRequestTransfer);
    }
}
