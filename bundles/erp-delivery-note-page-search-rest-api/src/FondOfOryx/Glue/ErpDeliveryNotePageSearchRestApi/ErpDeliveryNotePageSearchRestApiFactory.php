<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapper;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapper;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapper;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReader;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslator;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpDeliveryNotePageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface
     */
    public function createErpDeliveryNoteReader(): ErpDeliveryNotePageSearchReaderInterface
    {
        return new ErpDeliveryNotePageSearchReader(
            $this->getErpDeliveryNotePageSearchClient(),
            $this->createRequestBuilder(),
            $this->createRestErpDeliveryNotePageSearchCollectionResponseMapper(),
            $this->createRestErpDeliveryNotePageSearchCollectionResponseTranslator(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
     */
    protected function createRestErpDeliveryNotePageSearchCollectionResponseMapper(): RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
    {
        return new RestErpDeliveryNotePageSearchCollectionResponseMapper(
            $this->createRestErpDeliveryNotePageSearchPaginationMapper(),
            $this->createRestErpDeliveryNotePageSearchPaginationSortMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapperInterface
     */
    protected function createRestErpDeliveryNotePageSearchPaginationMapper(): RestErpDeliveryNotePageSearchPaginationMapperInterface
    {
        return new RestErpDeliveryNotePageSearchPaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapperInterface
     */
    protected function createRestErpDeliveryNotePageSearchPaginationSortMapper(): RestErpDeliveryNotePageSearchPaginationSortMapperInterface
    {
        return new RestErpDeliveryNotePageSearchPaginationSortMapper();
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
     */
    protected function createRestErpDeliveryNotePageSearchCollectionResponseTranslator(): RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
    {
        return new RestErpDeliveryNotePageSearchCollectionResponseTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected function createRequestBuilder(): RequestBuilderInterface
    {
        return new RequestBuilder();
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
     */
    protected function getErpDeliveryNotePageSearchClient(): ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
    {
        return $this->getProvidedDependency(
            ErpDeliveryNotePageSearchRestApiDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PAGE_SEARCH,
        );
    }

    /**
     * @return \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(
            ErpDeliveryNotePageSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE,
        );
    }
}
