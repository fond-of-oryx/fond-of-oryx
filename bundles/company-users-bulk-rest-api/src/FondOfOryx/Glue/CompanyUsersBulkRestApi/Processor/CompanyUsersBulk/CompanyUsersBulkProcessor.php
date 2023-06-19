<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\CompanyUsersBulk;

use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUsersBulkProcessor implements CompanyUsersBulkProcessorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface
     */
    protected RestCompanyUsersBulkRequestMapperInterface $restCompanyUsersBulkRequestMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $restResponseBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface $restCompanyUsersBulkRequestMapper
     * @param \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     */
    public function __construct(
        RestCompanyUsersBulkRequestMapperInterface $restCompanyUsersBulkRequestMapper,
        RestResponseBuilderInterface $restResponseBuilder
    ) {
        $this->restCompanyUsersBulkRequestMapper = $restCompanyUsersBulkRequestMapper;
        $this->restResponseBuilder = $restResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function saveCustomerCompanyRelation(
        RestRequestInterface $restRequest,
        RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
    ): RestResponseInterface {
        $restCompanyUsersBulkRequestTransfer = $this->restCompanyUsersBulkRequestMapper
            ->fromRestCompanyUsersBulkRequestAttributes($restCompanyUsersBulkRequestAttributesTransfer);
    }
}
