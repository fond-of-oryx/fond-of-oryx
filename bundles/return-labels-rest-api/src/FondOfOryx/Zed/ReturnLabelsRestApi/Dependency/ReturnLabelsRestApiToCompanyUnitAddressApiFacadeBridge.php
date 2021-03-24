<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency;

use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacadeInterface;
use Generated\Shared\Transfer\ApiItemTransfer;

class ReturnLabelsRestApiToCompanyUnitAddressApiFacadeBridge implements ReturnLabelsRestApiToCompanyUnitAddressApiFacadeInterface
{
    /**
     * @var CompanyUnitAddressApiFacadeInterface
     */
    protected $companyUnitAddressApiFacade;

    public function __construct(CompanyUnitAddressApiFacadeInterface $companyUnitAddressApiFacade)
    {
        $this->companyUnitAddressApiFacade = $companyUnitAddressApiFacade;
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
        return $this->companyUnitAddressApiFacade->getCompanyUnitAddress($idCompanyUnitAddress);
    }
}
