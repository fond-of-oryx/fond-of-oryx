<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\Propel\Mapper\ErpInvoicePageSearchMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\Propel\Mapper\ErpInvoicePageSearchMapperInterface;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepositoryInterface getRepository()
 */
class ErpInvoicePageSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\Propel\Mapper\ErpInvoicePageSearchMapperInterface
     */
    public function createErpInvoicePageSearchMapper(): ErpInvoicePageSearchMapperInterface
    {
        return new ErpInvoicePageSearchMapper();
    }

    /**
     * @return \Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery
     */
    public function getErpInvoicePageSearchQuery(): FooErpInvoicePageSearchQuery
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE_PAGE_SEARCH);
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function getErpInvoiceQuery(): FooErpInvoiceQuery
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE);
    }
}
