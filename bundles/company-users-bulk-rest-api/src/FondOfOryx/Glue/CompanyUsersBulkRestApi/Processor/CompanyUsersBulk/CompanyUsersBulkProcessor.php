<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\CompanyUsersBulk;

use FondOfOryx\Client\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiClientInterface;
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
     * @var \FondOfOryx\Client\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiClientInterface
     */
    protected CompanyUsersBulkRestApiClientInterface $client;

    /**
     * @param \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper\RestCompanyUsersBulkRequestMapperInterface $restCompanyUsersBulkRequestMapper
     * @param \FondOfOryx\Client\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiClientInterface $client
     * @param \FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     */
    public function __construct(
        RestCompanyUsersBulkRequestMapperInterface $restCompanyUsersBulkRequestMapper,
        CompanyUsersBulkRestApiClientInterface $client,
        RestResponseBuilderInterface $restResponseBuilder
    ) {
        $this->restCompanyUsersBulkRequestMapper = $restCompanyUsersBulkRequestMapper;
        $this->client = $client;
        $this->restResponseBuilder = $restResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function process(
        RestRequestInterface $restRequest,
        RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
    ): RestResponseInterface {
        $restCompanyUsersBulkRequestTransfer = $this->restCompanyUsersBulkRequestMapper
            ->createRequest($restRequest, $restCompanyUsersBulkRequestAttributesTransfer);

        $response = $this->client->bulkProcess($restCompanyUsersBulkRequestTransfer);

        if ($response->getError() !== null) {
            return $this->restResponseBuilder
                ->createRestErrorResponse($response->getError(), $response->getCode());
        }

        return $this->restResponseBuilder->buildEmptyRestResponse();
    }
}
