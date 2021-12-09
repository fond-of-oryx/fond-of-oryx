<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\DataProvider;

use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;

class CompanyProductListConnectorFormDataProvider implements CompanyProductListConnectorFormDataProviderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface
     */
    protected $companyProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade
     */
    public function __construct(
        CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade
    ) {
        $this->companyProductListConnectorFacade = $companyProductListConnectorFacade;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'data_class' => CompanyProductListConnectorFormTransfer::class,
        ];
    }

    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer
     */
    public function getData(int $idCompany): CompanyProductListConnectorFormTransfer
    {
        $assignedProductListIds = $this->companyProductListConnectorFacade->getAssignedProductListIdsByIdCompany(
            $idCompany,
        );

        return (new CompanyProductListConnectorFormTransfer())
            ->setIdCompany($idCompany)
            ->setAssignedProductListIds($assignedProductListIds);
    }
}
