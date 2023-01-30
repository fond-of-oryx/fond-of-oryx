<?php

namespace FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CompanyApi\CompanyApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyApi\CompanyApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyApi\Business\CompanyApiFacadeInterface getFacade()
 */
class CompanyApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyApiConfig::RESOURCE_COMPANIES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFacade()->validate($apiRequestTransfer);
    }
}
