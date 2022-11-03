<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Communication\Plugin\ReturnLabelsRestApiExtension;

use FondOfOryx\Zed\ReturnLabelsRestApiExtension\Dependency\Plugin\ReturnLabelRequestExpanderPluginInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorFacadeInterface getFacade()
 */
class CompanyReturnLabelRequestExpanderPlugin extends AbstractPlugin implements ReturnLabelRequestExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        return $this->getFacade()->expandReturnLabelRequest(
            $restReturnLabelRequestTransfer,
            $returnLabelRequestTransfer,
        );
    }
}
