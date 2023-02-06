<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapper;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapper;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapper;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReader;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReaderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslator;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpInvoicePageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReaderInterface
     */
    public function createErpInvoiceReader(): ErpInvoicePageSearchReaderInterface
    {
        return new ErpInvoicePageSearchReader(
            $this->getErpInvoicePageSearchClient(),
            $this->createRequestBuilder(),
            $this->createRestErpInvoicePageSearchCollectionResponseMapper(),
            $this->createRestErpInvoicePageSearchCollectionResponseTranslator(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface
     */
    protected function createRestErpInvoicePageSearchCollectionResponseMapper(): RestErpInvoicePageSearchCollectionResponseMapperInterface
    {
        return new RestErpInvoicePageSearchCollectionResponseMapper(
            $this->createRestErpInvoicePageSearchPaginationMapper(),
            $this->createRestErpInvoicePageSearchPaginationSortMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapperInterface
     */
    protected function createRestErpInvoicePageSearchPaginationMapper(): RestErpInvoicePageSearchPaginationMapperInterface
    {
        return new RestErpInvoicePageSearchPaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapperInterface
     */
    protected function createRestErpInvoicePageSearchPaginationSortMapper(): RestErpInvoicePageSearchPaginationSortMapperInterface
    {
        return new RestErpInvoicePageSearchPaginationSortMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface
     */
    protected function createRestErpInvoicePageSearchCollectionResponseTranslator(): RestErpInvoicePageSearchCollectionResponseTranslatorInterface
    {
        return new RestErpInvoicePageSearchCollectionResponseTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
     */
    protected function getErpInvoicePageSearchClient(): ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchRestApiDependencyProvider::CLIENT_ERP_INVOICE_PAGE_SEARCH);
    }

    /**
     * @return \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
