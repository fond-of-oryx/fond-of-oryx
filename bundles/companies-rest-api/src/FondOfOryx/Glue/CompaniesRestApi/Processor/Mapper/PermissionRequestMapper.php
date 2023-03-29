<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PermissionRequestMapper implements PermissionRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompaniesRestApiPermissionRequestTransfer
    {
        return (new CompaniesRestApiPermissionRequestTransfer())
            ->setCompanyUuid($this->getIdFromRequest($restRequest))
            ->setCustomerReference($this->getCustomerReference($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getIdFromRequest(RestRequestInterface $restRequest): ?string
    {
        return $restRequest->getResource()->getId();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string
     */
    protected function getCustomerReference(RestRequestInterface $restRequest): string
    {
        return $restRequest->getRestUser()->getNaturalIdentifier();
    }
}
