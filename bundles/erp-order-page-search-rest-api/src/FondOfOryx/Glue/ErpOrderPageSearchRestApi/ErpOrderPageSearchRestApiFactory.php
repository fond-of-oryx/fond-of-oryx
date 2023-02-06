<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapper;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapper;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapperInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapper;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapperInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReader;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslator;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpOrderPageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface
     */
    public function createErpOrderReader(): ErpOrderPageSearchReaderInterface
    {
        return new ErpOrderPageSearchReader(
            $this->getErpOrderPageSearchClient(),
            $this->createRequestBuilder(),
            $this->createErpOrderMapper(),
            $this->createRestErpOrderPageSearchCollectionResponseTranslator(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface
     */
    protected function createErpOrderMapper(): RestErpOrderPageSearchCollectionResponseMapperInterface
    {
        return new RestErpOrderPageSearchCollectionResponseMapper(
            $this->createRestErpOrderPageSearchPaginationMapper(),
            $this->createRestErpOrderPageSearchPaginationSortMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapperInterface
     */
    protected function createRestErpOrderPageSearchPaginationMapper(): RestErpOrderPageSearchPaginationMapperInterface
    {
        return new RestErpOrderPageSearchPaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapperInterface
     */
    protected function createRestErpOrderPageSearchPaginationSortMapper(): RestErpOrderPageSearchPaginationSortMapperInterface
    {
        return new RestErpOrderPageSearchPaginationSortMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface
     */
    protected function createRestErpOrderPageSearchCollectionResponseTranslator(): RestErpOrderPageSearchCollectionResponseTranslatorInterface
    {
        return new RestErpOrderPageSearchCollectionResponseTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
     */
    protected function getErpOrderPageSearchClient(): ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchRestApiDependencyProvider::CLIENT_ERP_ORDER_PAGE_SEARCH);
    }

    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): ErpOrderPageSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
