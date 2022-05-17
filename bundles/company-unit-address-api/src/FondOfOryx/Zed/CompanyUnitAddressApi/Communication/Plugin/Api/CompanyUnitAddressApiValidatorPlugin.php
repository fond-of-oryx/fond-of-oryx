<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacadeInterface getFacade()
 */
class CompanyUnitAddressApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
