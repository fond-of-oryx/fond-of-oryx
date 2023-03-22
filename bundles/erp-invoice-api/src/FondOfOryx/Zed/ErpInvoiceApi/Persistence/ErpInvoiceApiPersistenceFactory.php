<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Persistence;

use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiDependencyProvider;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig getConfig()
 */
class ErpInvoiceApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function getErpInvoiceQuery(): FooErpInvoiceQuery
    {
        return $this->getProvidedDependency(ErpInvoiceApiDependencyProvider::PROPEL_QUERY_ERP_INVOICE);
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): ErpInvoiceApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpInvoiceApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface
     */
    public function getApiFacade(): ErpInvoiceApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoiceApiDependencyProvider::FACADE_API);
    }
}
