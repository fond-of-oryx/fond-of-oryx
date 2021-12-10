<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication;

use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\CustomerProductListConnectorForm;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\DataProvider\CustomerProductListConnectorFormDataProvider;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\DataProvider\CustomerProductListConnectorFormDataProviderInterface;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper\CustomerProductListRelationMapper;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper\CustomerProductListRelationMapperInterface;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Table\AssignedProductListTable;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Table\AvailableProductListTable;
use FondOfOryx\Zed\CustomerProductListConnectorGui\CustomerProductListConnectorGuiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilEncodingServiceInterface;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilSanitizeServiceInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\ProductList\Persistence\Base\SpyProductListQuery;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

class CustomerProductListConnectorGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param int $idCustomer
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createCustomerProductListConnectorForm(int $idCustomer): FormInterface
    {
        $formDataProvider = $this->createCustomerProductListConnectorFormDataProvider();

        return $this->getFormFactory()->create(
            CustomerProductListConnectorForm::class,
            $formDataProvider->getData($idCustomer),
            $formDataProvider->getOptions(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\DataProvider\CustomerProductListConnectorFormDataProviderInterface
     */
    protected function createCustomerProductListConnectorFormDataProvider(): CustomerProductListConnectorFormDataProviderInterface
    {
        return new CustomerProductListConnectorFormDataProvider(
            $this->getCustomerProductListConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper\CustomerProductListRelationMapperInterface
     */
    public function createCustomerProductListRelationMapper(): CustomerProductListRelationMapperInterface
    {
        return new CustomerProductListRelationMapper();
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Table\AvailableProductListTable
     */
    public function createAvailableProductListTable(CustomerTransfer $customerTransfer): AvailableProductListTable
    {
        return new AvailableProductListTable(
            SpyProductListQuery::create(),
            $customerTransfer,
            $this->getUtilSanitizeService(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Table\AssignedProductListTable
     */
    public function createAssignedProductListTable(CustomerTransfer $customerTransfer): AssignedProductListTable
    {
        return new AssignedProductListTable(
            SpyProductListQuery::create(),
            $customerTransfer,
            $this->getUtilSanitizeService(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomerProductListConnectorGuiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerProductListConnectorGuiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface
     */
    public function getCustomerProductListConnectorFacade(): CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(CustomerProductListConnectorGuiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilSanitizeServiceInterface
     */
    protected function getUtilSanitizeService(): CustomerProductListConnectorGuiToUtilSanitizeServiceInterface
    {
        return $this->getProvidedDependency(CustomerProductListConnectorGuiDependencyProvider::SERVICE_UTIL_SANITIZE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): CustomerProductListConnectorGuiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CustomerProductListConnectorGuiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
