<?php

namespace FondOfOryx\Zed\ReturnLabel\Dependency\QueryContainer;

use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\CompanyUnitAddress\Persistence\CompanyUnitAddressQueryContainerInterface;

class ReturnLabelToCompanyUnitAddressQueryContainerBridge implements ReturnLabelToCompanyUnitAddressQueryContainerInterface
{
    /**
     * @var CompanyUnitAddressQueryContainerInterface
     */
    protected $companyUnitAddressQueryContainer;

    /**
     * @param CompanyUnitAddressQueryContainerInterface $companyUnitAddressQueryContainer
     */
    public function __construct(CompanyUnitAddressQueryContainerInterface $companyUnitAddressQueryContainer)
    {
        $this->companyUnitAddressQueryContainer = $companyUnitAddressQueryContainer;
    }

    /**
     * @return SpyCompanyUnitAddressQuery
     */
    public function queryCompanyUnitAddress(): SpyCompanyUnitAddressQuery
    {
        return $this->companyUnitAddressQueryContainer->queryCompanyUnitAddress();
    }
}
