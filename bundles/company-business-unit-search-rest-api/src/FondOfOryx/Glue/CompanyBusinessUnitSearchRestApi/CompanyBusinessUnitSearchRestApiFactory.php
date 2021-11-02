<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilter;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapper;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader\CompanyBusinessUnitReader;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader\CompanyBusinessUnitReaderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslator;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig getConfig()
 */
class CompanyBusinessUnitSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader\CompanyBusinessUnitReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->createCompanyBusinessUnitListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapper
     */
    protected function createCompanyBusinessUnitListMapper(): CompanyBusinessUnitListMapper
    {
        return new CompanyBusinessUnitListMapper(
            $this->createPaginationMapper(),
            $this->createRequestParameterFilter(),
            $this->createCustomerReferenceFilter(),
            $this->createCustomerIdFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected function createCustomerIdFilter(): CustomerIdFilterInterface
    {
        return new CustomerIdFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCompanyBusinessUnitSearchAttributesTranslator(),
            $this->createRestCompanyBusinessUnitSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapperInterface
     */
    protected function createRestCompanyBusinessUnitSearchAttributesMapper(): RestCompanyBusinessUnitSearchAttributesMapperInterface
    {
        return new RestCompanyBusinessUnitSearchAttributesMapper(
            $this->createRestCompanyBusinessUnitSearchResultItemMapper(),
            $this->createRestCompanyBusinessUnitSearchSortMapper(),
            $this->createRestCompanyBusinessUnitSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapperInterface
     */
    protected function createRestCompanyBusinessUnitSearchResultItemMapper(): RestCompanyBusinessUnitSearchResultItemMapperInterface
    {
        return new RestCompanyBusinessUnitSearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapperInterface
     */
    protected function createRestCompanyBusinessUnitSearchSortMapper(): RestCompanyBusinessUnitSearchSortMapperInterface
    {
        return new RestCompanyBusinessUnitSearchSortMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapperInterface
     */
    protected function createRestCompanyBusinessUnitSearchPaginationMapper(): RestCompanyBusinessUnitSearchPaginationMapperInterface
    {
        return new RestCompanyBusinessUnitSearchPaginationMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslatorInterface
     */
    protected function createRestCompanyBusinessUnitSearchAttributesTranslator(): RestCompanyBusinessUnitSearchAttributesTranslatorInterface
    {
        return new RestCompanyBusinessUnitSearchAttributesTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
