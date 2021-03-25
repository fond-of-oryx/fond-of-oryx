<?php

namespace FondOfOryx\Zed\ReturnLabel;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use FondOfOryx\Shared\ReturnLabel\ReturnLabelConstants;

class ReturnLabelConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getReturnLabelMicroServiceUrl(): string
    {
        return $this->get(ReturnLabelConstants::RETURN_LABEL_MICRO_SERVICE_URL, '');
    }
}
