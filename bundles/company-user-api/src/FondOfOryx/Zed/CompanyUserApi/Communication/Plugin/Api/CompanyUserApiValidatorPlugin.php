<?php

namespace FondOfOryx\Zed\CompanyUserApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\ApiExtension\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 */
class CompanyUserApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyUserApiConfig::RESOURCE_COMPANY_USERS;
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
