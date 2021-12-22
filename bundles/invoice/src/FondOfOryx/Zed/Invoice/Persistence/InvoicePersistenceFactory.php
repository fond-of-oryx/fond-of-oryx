<?php

namespace FondOfOryx\Zed\Invoice\Persistence;

use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceAddressMapper;
use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceAddressMapperInterface;
use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceItemMapper;
use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceItemMapperInterface;
use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceMapper;
use FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceMapperInterface;
use Orm\Zed\Invoice\Persistence\FooInvoiceItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceRepositoryInterface getRepository()
 */
class InvoicePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Invoice\Persistence\FooInvoiceItemQuery
     */
    public function createInvoiceItemQuery(): FooInvoiceItemQuery
    {
        return FooInvoiceItemQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceMapperInterface
     */
    public function createInvoiceMapper(): InvoiceMapperInterface
    {
        return new InvoiceMapper();
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceAddressMapperInterface
     */
    public function createInvoiceAddressMapper(): InvoiceAddressMapperInterface
    {
        return new InvoiceAddressMapper();
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper\InvoiceItemMapperInterface
     */
    public function createInvoiceItemMapper(): InvoiceItemMapperInterface
    {
        return new InvoiceItemMapper();
    }
}
