<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilter;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilter;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilter;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapper;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReader;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReaderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslator;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig getConfig()
 */
class CompanyBusinessUnitAddressSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReaderInterface
     */
    public function createCompanyBusinessUnitAddressReader(): CompanyBusinessUnitAddressReaderInterface
    {
        return new CompanyBusinessUnitAddressReader(
            $this->createCompanyBusinessUnitAddressListMapper(),
            $this->createRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapper
     */
    protected function createCompanyBusinessUnitAddressListMapper(): CompanyBusinessUnitAddressListMapper
    {
        return new CompanyBusinessUnitAddressListMapper(
            $this->createPaginationMapper(),
            $this->createRequestParameterFilter(),
            $this->createCustomerReferenceFilter(),
            $this->createCustomerIdFilter()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected function createPaginationMapper(): PaginationMapperInterface
    {
        return new PaginationMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected function createRequestParameterFilter(): RequestParameterFilterInterface
    {
        return new RequestParameterFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected function createCustomerReferenceFilter(): CustomerReferenceFilterInterface
    {
        return new CustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected function createCustomerIdFilter(): CustomerIdFilterInterface
    {
        return new CustomerIdFilter();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder(
            $this->createRestCompanyBusinessUnitAddressSearchAttributesTranslator(),
            $this->createRestCompanyBusinessUnitAddressSearchAttributesMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface
     */
    protected function createRestCompanyBusinessUnitAddressSearchAttributesMapper(): RestCompanyBusinessUnitAddressSearchAttributesMapperInterface
    {
        return new RestCompanyBusinessUnitAddressSearchAttributesMapper(
            $this->createRestCompanyBusinessUnitAddressSearchResultItemMapper(),
            $this->createRestCompanyBusinessUnitAddressSearchSortMapper(),
            $this->createRestCompanyBusinessUnitAddressSearchPaginationMapper()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
     */
    protected function createRestCompanyBusinessUnitAddressSearchResultItemMapper(): RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
    {
        return new RestCompanyBusinessUnitAddressSearchResultItemMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapperInterface
     */
    protected function createRestCompanyBusinessUnitAddressSearchSortMapper(): RestCompanyBusinessUnitAddressSearchSortMapperInterface
    {
        return new RestCompanyBusinessUnitAddressSearchSortMapper(
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapperInterface
     */
    protected function createRestCompanyBusinessUnitAddressSearchPaginationMapper(): RestCompanyBusinessUnitAddressSearchPaginationMapperInterface
    {
        return new RestCompanyBusinessUnitAddressSearchPaginationMapper(
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface
     */
    protected function createRestCompanyBusinessUnitAddressSearchAttributesTranslator(): RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface
    {
        return new RestCompanyBusinessUnitAddressSearchAttributesTranslator(
            $this->getGlossaryStorageClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface
     */
    protected function getGlossaryStorageClient(): CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressSearchRestApiDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }
}
