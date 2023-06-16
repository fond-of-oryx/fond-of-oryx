<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStub;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class RepresentativeCompanyUserTradeFairRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStubInterface
     */
    public function createZedRepresentativeCompanyUserTradeFairRestApiStub(): RepresentativeCompanyUserTradeFairRestApiStubInterface
    {
        return new RepresentativeCompanyUserTradeFairRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
