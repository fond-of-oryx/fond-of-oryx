<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilter;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapper;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReader;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReaderInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslator;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig getConfig()
 */
class CompanyRoleSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReaderInterface
     */
    public function createCompanyRoleReader(): CompanyRoleReaderInterface
    {
        return new CompanyRoleReader(
            $this->createCompanyRoleListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface
     */
    protected function createCompanyRoleListMapper(): CompanyRoleListMapperInterface
    {
        return new CompanyRoleListMapper(
            $this->createPaginationMapper(),
            $this->createRequestParameterFilter(),
            $this->createCustomerReferenceFilter(),
            $this->createCustomerIdFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected function createCustomerIdFilter(): CustomerIdFilterInterface
    {
        return new CustomerIdFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCompanyRoleSearchAttributesTranslator(),
            $this->createRestCompanyRoleSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapperInterface
     */
    protected function createRestCompanyRoleSearchAttributesMapper(): RestCompanyRoleSearchAttributesMapperInterface
    {
        return new RestCompanyRoleSearchAttributesMapper(
            $this->createRestCompanyRoleSearchResultItemMapper(),
            $this->createRestCompanyRoleSearchSortMapper(),
            $this->createRestCompanyRoleSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapperInterface
     */
    protected function createRestCompanyRoleSearchResultItemMapper(): RestCompanyRoleSearchResultItemMapperInterface
    {
        return new RestCompanyRoleSearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapperInterface
     */
    protected function createRestCompanyRoleSearchSortMapper(): RestCompanyRoleSearchSortMapperInterface
    {
        return new RestCompanyRoleSearchSortMapper($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapperInterface
     */
    protected function createRestCompanyRoleSearchPaginationMapper(): RestCompanyRoleSearchPaginationMapperInterface
    {
        return new RestCompanyRoleSearchPaginationMapper($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslatorInterface
     */
    protected function createRestCompanyRoleSearchAttributesTranslator(): RestCompanyRoleSearchAttributesTranslatorInterface
    {
        return new RestCompanyRoleSearchAttributesTranslator($this->getGlossaryStorageClient());
    }

    /**
     * @return \FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CompanyRoleSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CompanyRoleSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
