<?php

namespace FondOfOryx\Glue\CartSearchRestApi;

use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpander;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\AllFilterFieldMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\OrderByFilterFieldMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapper;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReader;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReaderInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslator;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig getConfig()
 */
class CartSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReaderInterface
     */
    public function createCartReader(): CartReaderInterface
    {
        return new CartReader(
            $this->createCustomerReferenceFilter(),
            $this->createQuoteListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapper
     */
    protected function createQuoteListMapper(): QuoteListMapper
    {
        return new QuoteListMapper(
            $this->createFilterFieldsMapper(),
            $this->createPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected function createFilterFieldsMapper(): FilterFieldsMapperInterface
    {
        return new FilterFieldsMapper(
            $this->createFilterFieldMappers(),
            $this->createFilterFieldsExpander(),
        );
    }

    /**
     * @return array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface>
     */
    protected function createFilterFieldMappers(): array
    {
        return [
            new AllFilterFieldMapper($this->createRequestParameterFilter()),
            new OrderByFilterFieldMapper(
                $this->createRequestParameterFilter(),
                $this->getConfig(),
            ),
        ];
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCartSearchAttributesTranslator(),
            $this->createRestCartSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface
     */
    protected function createRestCartSearchAttributesTranslator(): RestCartSearchAttributesTranslatorInterface
    {
        return new RestCartSearchAttributesTranslator($this->getGlossaryStorageClient());
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CartSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CartSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface
     */
    protected function createRestCartSearchAttributesMapper(): RestCartSearchAttributesMapperInterface
    {
        return new RestCartSearchAttributesMapper(
            $this->createRestCartsAttributesMapper(),
            $this->createRestCartSearchSortMapper(),
            $this->createRestCartSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapperInterface
     */
    protected function createRestCartsAttributesMapper(): RestCartsAttributesMapperInterface
    {
        return new RestCartsAttributesMapper(
            $this->createRestCartsDiscountsMapper(),
            $this->createRestCartsTotalsMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapperInterface
     */
    protected function createRestCartsDiscountsMapper(): RestCartsDiscountsMapperInterface
    {
        return new RestCartsDiscountsMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapperInterface
     */
    protected function createRestCartsTotalsMapper(): RestCartsTotalsMapperInterface
    {
        return new RestCartsTotalsMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapperInterface
     */
    protected function createRestCartSearchSortMapper(): RestCartSearchSortMapperInterface
    {
        return new RestCartSearchSortMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapperInterface
     */
    protected function createRestCartSearchPaginationMapper(): RestCartSearchPaginationMapperInterface
    {
        return new RestCartSearchPaginationMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface
     */
    protected function createFilterFieldsExpander(): FilterFieldsExpanderInterface
    {
        return new FilterFieldsExpander(
            $this->getFilterFieldsExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            CartSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER,
        );
    }
}
