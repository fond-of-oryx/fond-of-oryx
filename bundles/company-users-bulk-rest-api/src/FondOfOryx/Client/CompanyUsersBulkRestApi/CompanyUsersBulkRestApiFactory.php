<?php

namespace FondOfOryx\Client\CompanyUsersBulkRestApi;

use FondOfOryx\Client\CompanyUsersBulkRestApi\Dependency\Client\CompanyUsersBulkRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyUsersBulkRestApi\Zed\CompanyUsersBulkRestApiStub;
use FondOfOryx\Client\CompanyUsersBulkRestApi\Zed\CompanyUsersBulkRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyUsersBulkRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanyUsersBulkRestApi\Zed\CompanyUsersBulkRestApiStubInterface
     */
    public function createZedCompanyUsersBulkRestApiStub(): CompanyUsersBulkRestApiStubInterface
    {
        return new CompanyUsersBulkRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanyUsersBulkRestApi\Dependency\Client\CompanyUsersBulkRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyUsersBulkRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyUsersBulkRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
