<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector;

use FondOfOryx\Shared\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ReturnLabelsRestApiCompanyUnitAddressConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getReceiver(): array
    {
        return $this->get(ReturnLabelsRestApiCompanyUnitAddressConnectorConstants::RECEIVER_IDS, []);
    }
}
