<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacadeInterface getFacade()
 */
class CompanyBusinessUnitApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyBusinessUnitApiConfig::RESOURCE_COMPANY_BUSINESS_UNITS;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->addCompanyBusinessUnit($apiDataTransfer);
    }

    /**
     * @api
     *
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($id): ApiItemTransfer
    {
        return $this->getFacade()->getCompanyBusinessUnit($id);
    }

    /**
     * @api
     *
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->updateCompanyBusinessUnit($id, $apiDataTransfer);
    }

    /**
     * @api
     *
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($id): ApiItemTransfer
    {
        return $this->getFacade()->removeCompanyBusinessUnit($id);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findCompanyBusinessUnits($apiRequestTransfer);
    }
}
