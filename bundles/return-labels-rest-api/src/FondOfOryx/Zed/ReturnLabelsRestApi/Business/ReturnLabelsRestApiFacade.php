<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
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
     * @return RestReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer
    {
        return $this->getFactory()
            ->createReturnLabelGenerator()
            ->generate($restReturnLabelRequestTransfer);
    }
}
