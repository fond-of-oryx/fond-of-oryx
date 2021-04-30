<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi;

use FondOfOryx\Shared\ReturnLabelsRestApi\ReturnLabelsRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ReturnLabelsRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getAllowedCountryIso3(): array
    {
        return $this->get(ReturnLabelsRestApiConstants::ALLOWED_COUNTRY_ISO3, []);
    }
}
