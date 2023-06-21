<?php

namespace FondOfOryx\Glue\CompanySearchRestApi;

use FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpander;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\AllFilterFieldMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\OrderByFilterFieldMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapper;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader\CompanyReader;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader\CompanyReaderInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslator;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig getConfig()
 */
class CompanySearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Reader\CompanyReaderInterface
     */
    public function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->createCompanyListMapper(),
            $this->createCustomerReferenceFilter(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapper
     */
    protected function createCompanyListMapper(): CompanyListMapper
    {
        return new CompanyListMapper(
            $this->createPaginationMapper(),
            $this->createFilterFieldsMapper(),
            $this->createRequestParameterFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCompanySearchAttributesTranslator(),
            $this->createRestCompanySearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface
     */
    protected function createRestCompanySearchAttributesMapper(): RestCompanySearchAttributesMapperInterface
    {
        return new RestCompanySearchAttributesMapper(
            $this->createRestCompanySearchResultItemMapper(),
            $this->createRestCompanySearchSortMapper(),
            $this->createRestCompanySearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapperInterface
     */
    protected function createRestCompanySearchResultItemMapper(): RestCompanySearchResultItemMapperInterface
    {
        return new RestCompanySearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapperInterface
     */
    protected function createRestCompanySearchSortMapper(): RestCompanySearchSortMapperInterface
    {
        return new RestCompanySearchSortMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapperInterface
     */
    protected function createRestCompanySearchPaginationMapper(): RestCompanySearchPaginationMapperInterface
    {
        return new RestCompanySearchPaginationMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface
     */
    protected function createRestCompanySearchAttributesTranslator(): RestCompanySearchAttributesTranslatorInterface
    {
        return new RestCompanySearchAttributesTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected function createFilterFieldsMapper(): FilterFieldsMapperInterface
    {
        return new FilterFieldsMapper(
            [
                new AllFilterFieldMapper($this->createRequestParameterFilter()),
                new OrderByFilterFieldMapper($this->createRequestParameterFilter(), $this->getConfig()),
            ],
            $this->createFilterFieldsExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpanderInterface
     */
    protected function createFilterFieldsExpander(): FilterFieldsExpanderInterface
    {
        return new FilterFieldsExpander(
            $this->getFilterFieldsExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanySearchRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER,
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CompanySearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CompanySearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
