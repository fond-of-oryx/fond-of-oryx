<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApi;


use Spryker\Zed\Kernel\AbstractBundleConfig;
use FondOfOryx\Shared\ReturnLabelsRestApi\ReturnLabelsRestApiConstants;

class ReturnLabelsRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getAllowedCountryIds(): array
    {
        return $this->get(ReturnLabelsRestApiConstants::ALLOWED_COUNTRY_IDS, []);
    }
}
