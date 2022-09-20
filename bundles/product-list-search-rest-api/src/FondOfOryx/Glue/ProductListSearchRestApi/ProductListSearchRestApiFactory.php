<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi;

use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapper;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader\ProductListReader;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader\ProductListReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig getConfig()
 */
class ProductListSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader\ProductListReaderInterface
     */
    public function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->createProductListCollectionMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface
     */
    protected function createProductListCollectionMapper(): ProductListCollectionMapperInterface
    {
        return new ProductListCollectionMapper(
            $this->createPaginationMapper(),
            $this->createRequestParameterFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestProductListSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface
     */
    protected function createRestProductListSearchAttributesMapper(): RestProductListSearchAttributesMapperInterface
    {
        return new RestProductListSearchAttributesMapper(
            $this->createRestProductListSearchResultItemMapper(),
            $this->createRestProductListSearchSortMapper(),
            $this->createRestProductListSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapperInterface
     */
    protected function createRestProductListSearchResultItemMapper(): RestProductListSearchResultItemMapperInterface
    {
        return new RestProductListSearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapperInterface
     */
    protected function createRestProductListSearchSortMapper(): RestProductListSearchSortMapperInterface
    {
        return new RestProductListSearchSortMapper($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapperInterface
     */
    protected function createRestProductListSearchPaginationMapper(): RestProductListSearchPaginationMapperInterface
    {
        return new RestProductListSearchPaginationMapper($this->getConfig());
    }
}
