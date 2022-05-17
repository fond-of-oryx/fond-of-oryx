<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory getFactory()
 */
class CompanyUnitAddressApiFacade extends AbstractFacade implements CompanyUnitAddressApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyUnitAddress(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUnitAddressApi()->add($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyUnitAddress(int $idCompanyUnitAddress): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUnitAddressApi()->get($idCompanyUnitAddress);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyUnitAddress(int $idCompanyUnitAddress, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUnitAddressApi()->update($idCompanyUnitAddress, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyUnitAddress(int $idCompanyUnitAddress): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUnitAddressApi()->remove($idCompanyUnitAddress);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyUnitAddresses(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createCompanyUnitAddressApi()->find($apiRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()->createCompanyUnitAddressApiValidator()->validate($apiDataTransfer);
    }
}
