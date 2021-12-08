<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication;

use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\CompanyProductListConnectorForm;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\DataProvider\CompanyProductListConnectorFormDataProvider;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\DataProvider\CompanyProductListConnectorFormDataProviderInterface;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper\CompanyProductListRelationMapper;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper\CompanyProductListRelationMapperInterface;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Table\AssignedProductListTable;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Table\AvailableProductListTable;
use FondOfOryx\Zed\CompanyProductListConnectorGui\CompanyProductListConnectorGuiDependencyProvider;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilEncodingServiceInterface;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilSanitizeServiceInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

class CompanyProductListConnectorGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param int $idCompany
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createCompanyProductListConnectorForm(int $idCompany): FormInterface
    {
        $formDataProvider = $this->createCompanyProductListConnectorFormDataProvider();

        return $this->getFormFactory()->create(
            CompanyProductListConnectorForm::class,
            $formDataProvider->getData($idCompany),
            $formDataProvider->getOptions(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form\DataProvider\CompanyProductListConnectorFormDataProviderInterface
     */
    protected function createCompanyProductListConnectorFormDataProvider(): CompanyProductListConnectorFormDataProviderInterface
    {
        return new CompanyProductListConnectorFormDataProvider(
            $this->getCompanyProductListConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper\CompanyProductListRelationMapperInterface
     */
    public function createCompanyProductListRelationMapper(): CompanyProductListRelationMapperInterface
    {
        return new CompanyProductListRelationMapper();
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Table\AvailableProductListTable
     */
    public function createAvailableProductListTable(CompanyTransfer $companyTransfer): AvailableProductListTable
    {
        return new AvailableProductListTable(
            SpyProductListQuery::create(),
            $companyTransfer,
            $this->getUtilSanitizeService(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Table\AssignedProductListTable
     */
    public function createAssignedProductListTable(CompanyTransfer $companyTransfer): AssignedProductListTable
    {
        return new AssignedProductListTable(
            SpyProductListQuery::create(),
            $companyTransfer,
            $this->getUtilSanitizeService(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyFacadeInterface
     */
    public function getCompanyFacade(): CompanyProductListConnectorGuiToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyProductListConnectorGuiDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface
     */
    public function getCompanyProductListConnectorFacade(): CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(CompanyProductListConnectorGuiDependencyProvider::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilSanitizeServiceInterface
     */
    protected function getUtilSanitizeService(): CompanyProductListConnectorGuiToUtilSanitizeServiceInterface
    {
        return $this->getProvidedDependency(CompanyProductListConnectorGuiDependencyProvider::SERVICE_UTIL_SANITIZE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): CompanyProductListConnectorGuiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CompanyProductListConnectorGuiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
