<?php

namespace FondOfOryx\Client\CompaniesRestApi;

use FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStub;
use FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompaniesRestApi\Zed\CompaniesRestApiStubInterface
     */
    public function createZedCompaniesRestApiStub(): CompaniesRestApiStubInterface
    {
        return new CompaniesRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompaniesRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
