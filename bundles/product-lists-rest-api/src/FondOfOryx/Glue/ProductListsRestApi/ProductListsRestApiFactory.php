<?php

namespace FondOfOryx\Glue\ProductListsRestApi;

use FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdCustomerFilter;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdCustomerFilterInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilter;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapper;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapper;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdater;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdaterInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface getClient()
 */
class ProductListsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdaterInterface
     */
    public function createProductListUpdater(): ProductListUpdaterInterface
    {
        return new ProductListUpdater(
            $this->createRestResponseBuilder(),
            $this->createRestProductListUpdateRequestMapper(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestProductListsAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface
     */
    protected function createRestProductListUpdateRequestMapper(): RestProductListUpdateRequestMapperInterface
    {
        return new RestProductListUpdateRequestMapper(
            $this->createIdProductListFilter(),
            $this->createIdCustomerFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface
     */
    protected function createIdProductListFilter(): IdProductListFilterInterface
    {
        return new IdProductListFilter();
    }

    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface
     */
    protected function createRestProductListsAttributesMapper(): RestProductListResponseAttributesMapperInterface
    {
        return new RestProductListResponseAttributesMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdCustomerFilterInterface
     */
    protected function createIdCustomerFilter(): IdCustomerFilterInterface
    {
        return new IdCustomerFilter();
    }
}
