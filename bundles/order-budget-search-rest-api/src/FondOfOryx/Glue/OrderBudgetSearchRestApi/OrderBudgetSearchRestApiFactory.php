<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Expander\FilterFieldsExpander;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\AllFilterFieldMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldsMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderByFilterFieldMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapper;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReader;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslator;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig getConfig()
 * @method \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface getClient()
 */
class OrderBudgetSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReaderInterface
     */
    public function createOrderBudgetReader(): OrderBudgetReaderInterface
    {
        return new OrderBudgetReader(
            $this->createCustomerReferenceFilter(),
            $this->createOrderBudgetListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapper
     */
    protected function createOrderBudgetListMapper(): OrderBudgetListMapperInterface
    {
        return new OrderBudgetListMapper(
            $this->createFilterFieldsMapper(),
            $this->createPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected function createFilterFieldsMapper(): FilterFieldsMapperInterface
    {
        return new FilterFieldsMapper(
            $this->createFilterFieldMappers(),
            $this->createFilterFieldsExpander(),
        );
    }

    /**
     * @return array<\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\FilterFieldMapperInterface>
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
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestOrderBudgetSearchAttributesTranslator(),
            $this->createRestOrderBudgetSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface
     */
    protected function createRestOrderBudgetSearchAttributesTranslator(): RestOrderBudgetSearchAttributesTranslatorInterface
    {
        return new RestOrderBudgetSearchAttributesTranslator($this->getGlossaryStorageClient());
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): OrderBudgetSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(OrderBudgetSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface
     */
    protected function createRestOrderBudgetSearchAttributesMapper(): RestOrderBudgetSearchAttributesMapperInterface
    {
        return new RestOrderBudgetSearchAttributesMapper(
            $this->createRestOrderBudgetsAttributesMapper(),
            $this->createRestOrderBudgetSearchSortMapper(),
            $this->createRestOrderBudgetSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapperInterface
     */
    protected function createRestOrderBudgetsAttributesMapper(): RestOrderBudgetsAttributesMapperInterface
    {
        return new RestOrderBudgetsAttributesMapper();
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapperInterface
     */
    protected function createRestOrderBudgetSearchSortMapper(): RestOrderBudgetSearchSortMapperInterface
    {
        return new RestOrderBudgetSearchSortMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapperInterface
     */
    protected function createRestOrderBudgetSearchPaginationMapper(): RestOrderBudgetSearchPaginationMapperInterface
    {
        return new RestOrderBudgetSearchPaginationMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface
     */
    protected function createFilterFieldsExpander(): FilterFieldsExpanderInterface
    {
        return new FilterFieldsExpander(
            $this->getFilterFieldsExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Glue\OrderBudgetSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            OrderBudgetSearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER,
        );
    }
}
