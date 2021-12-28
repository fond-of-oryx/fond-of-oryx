<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitApiFacade extends AbstractFacade implements CompanyBusinessUnitApiFacadeInterface
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
    public function addCompanyBusinessUnit(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyBusinessUnitApi()->add($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyBusinessUnit(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyBusinessUnitApi()->get($idCompanyBusinessUnit);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyBusinessUnit(int $idCompanyBusinessUnit, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyBusinessUnitApi()->update($idCompanyBusinessUnit, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyBusinessUnit(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyBusinessUnitApi()->remove($idCompanyBusinessUnit);
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
    public function findCompanyBusinessUnits(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createCompanyBusinessUnitApi()->find($apiRequestTransfer);
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
        return $this->getFactory()->createCompanyBusinessUnitApiValidator()->validate($apiDataTransfer);
    }
}
