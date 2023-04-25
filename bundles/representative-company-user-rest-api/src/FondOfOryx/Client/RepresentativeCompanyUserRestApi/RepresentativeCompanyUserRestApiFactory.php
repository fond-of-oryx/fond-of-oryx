<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi;

use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed\RepresentativeCompanyUserRestApiStub;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed\RepresentativeCompanyUserRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class RepresentativeCompanyUserRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed\RepresentativeCompanyUserRestApiStubInterface
     */
    public function createZedRepresentativeCompanyUserRestApiStub(): RepresentativeCompanyUserRestApiStubInterface
    {
        return new RepresentativeCompanyUserRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): RepresentativeCompanyUserRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
