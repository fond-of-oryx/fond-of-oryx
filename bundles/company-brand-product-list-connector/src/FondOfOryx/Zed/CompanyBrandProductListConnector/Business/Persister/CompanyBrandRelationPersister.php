<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister;

use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyBrandRelationPersister implements CompanyBrandRelationPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface
     */
    protected $brandReader;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface
     */
    protected $brandCompanyFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface $brandReader
     * @param \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface $brandCompanyFacade
     */
    public function __construct(
        BrandReaderInterface $brandReader,
        CompanyBrandProductListConnectorToBrandCompanyFacadeInterface $brandCompanyFacade
    ) {
        $this->brandReader = $brandReader;
        $this->brandCompanyFacade = $brandCompanyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void {
        $idCompany = $companyProductListRelationTransfer->getIdCompany();

        if ($idCompany === null) {
            return;
        }

        $brandIds = $this->brandReader->getBrandIdsByCompanyProductListRelation($companyProductListRelationTransfer);

        $companyBrandRelationTransfer = (new CompanyBrandRelationTransfer())
            ->setIdBrands($brandIds)
            ->setIdCompany($companyProductListRelationTransfer->getIdCompany());

        $this->brandCompanyFacade->saveCompanyBrandRelation($companyBrandRelationTransfer);
    }
}
