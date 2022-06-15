<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade;

use FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListApiToCompanyProductListConnectorFacadeBridge implements CompanyProductListApiToCompanyProductListConnectorFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface
     */
    protected $companyProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade
     */
    public function __construct(CompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade)
    {
        $this->companyProductListConnectorFacade = $companyProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void {
        $this->companyProductListConnectorFacade->persistCompanyProductListRelation($companyProductListRelationTransfer);
    }
}
