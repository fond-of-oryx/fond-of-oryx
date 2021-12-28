<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Communication\Plugin\Api;

use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\ApiDispatchingException;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiFacadeInterface getFacade()
 */
class CompanyRoleApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyRoleApiConfig::RESOURCE_COMPANY_ROLES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        throw new ApiDispatchingException(
            'Add action is not implemented yet.',
            ApiConfig::HTTP_CODE_NOT_FOUND,
        );
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($id): ApiItemTransfer
    {
        return $this->getFacade()->getCompanyRole($id);
    }

    /**
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        throw new ApiDispatchingException(
            'Update action is not implemented yet.',
            ApiConfig::HTTP_CODE_NOT_FOUND,
        );
    }

    /**
     * @param int $id
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiDispatchingException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($id): ApiItemTransfer
    {
        throw new ApiDispatchingException(
            'Remove action is not implemented yet.',
            ApiConfig::HTTP_CODE_NOT_FOUND,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findCompanyRoles($apiRequestTransfer);
    }
}
