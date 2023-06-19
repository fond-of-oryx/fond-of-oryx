<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi;

use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\CompanyUsersBulk\CompanyUsersBulkProcessor;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\CompanyUsersBulk\CompanyUsersBulkProcessorInterface;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapper;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUsersBulkRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\CompanyUsersBulk\CompanyUsersBulkProcessorInterface
     */
    public function createCompanyUsersBulkProcessor(): CompanyUsersBulkProcessorInterface
    {
        return new CompanyUsersBulkProcessor(
            $this->createRestCompanyUsersBulkRequestMapper(),
            $this->createRestResponseBuilder()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface
     */
    protected function createRestCompanyUsersBulkRequestMapper(): RestCompanyUsersBulkRequestMapperInterface
    {
        return new RestCompanyUsersBulkRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }
}
