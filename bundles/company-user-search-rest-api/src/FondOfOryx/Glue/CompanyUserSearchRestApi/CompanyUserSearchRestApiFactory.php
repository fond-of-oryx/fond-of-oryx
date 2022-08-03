<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi;

use FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilter;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilter;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapper;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader\CompanyUserReader;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader\CompanyUserReaderInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslator;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig getConfig()
 */
class CompanyUserSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader\CompanyUserReaderInterface
     */
    public function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->createCompanyUserListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapper
     */
    protected function createCompanyUserListMapper(): CompanyUserListMapper
    {
        return new CompanyUserListMapper(
            $this->createPaginationMapper(),
            $this->createRequestParameterFilter(),
            $this->createCustomerReferenceFilter(),
            $this->createCustomerIdFilter(),
            $this->createCompanyRoleNameFilter(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected function createCustomerIdFilter(): CustomerIdFilterInterface
    {
        return new CustomerIdFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCompanyUserSearchAttributesTranslator(),
            $this->createRestCompanyUserSearchAttributesMapper(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface
     */
    protected function createRestCompanyUserSearchAttributesMapper(): RestCompanyUserSearchAttributesMapperInterface
    {
        return new RestCompanyUserSearchAttributesMapper(
            $this->createRestCompanyUserSearchResultItemMapper(),
            $this->createRestCompanyUserSearchSortMapper(),
            $this->createRestCompanyUserSearchPaginationMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapperInterface
     */
    protected function createRestCompanyUserSearchResultItemMapper(): RestCompanyUserSearchResultItemMapperInterface
    {
        return new RestCompanyUserSearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapperInterface
     */
    protected function createRestCompanyUserSearchSortMapper(): RestCompanyUserSearchSortMapperInterface
    {
        return new RestCompanyUserSearchSortMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapperInterface
     */
    protected function createRestCompanyUserSearchPaginationMapper(): RestCompanyUserSearchPaginationMapperInterface
    {
        return new RestCompanyUserSearchPaginationMapper(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface
     */
    protected function createRestCompanyUserSearchAttributesTranslator(): RestCompanyUserSearchAttributesTranslatorInterface
    {
        return new RestCompanyUserSearchAttributesTranslator(
            $this->getGlossaryStorageClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CompanyUserSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CompanyUserSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface
     */
    protected function createCompanyRoleNameFilter(): CompanyRoleNameFilterInterface
    {
        return new CompanyRoleNameFilter();
    }
}
