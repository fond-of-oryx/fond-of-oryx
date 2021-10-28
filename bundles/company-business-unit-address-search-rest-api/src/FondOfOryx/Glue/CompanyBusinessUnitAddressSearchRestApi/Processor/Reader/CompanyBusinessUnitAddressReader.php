<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader;

use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitAddressReader implements CompanyBusinessUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapperInterface
     */
    protected $companyBusinessUnitAddressListMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapperInterface $companyBusinessUnitAddressListMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClientInterface $client
     */
    public function __construct(
        CompanyBusinessUnitAddressListMapperInterface $companyBusinessUnitAddressListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CompanyBusinessUnitAddressSearchRestApiClientInterface $client
    ) {
        $this->companyBusinessUnitAddressListMapper = $companyBusinessUnitAddressListMapper;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function find(RestRequestInterface $restRequest): RestResponseInterface
    {
        $companyBusinessUnitAddressListTransfer = $this->companyBusinessUnitAddressListMapper->fromRestRequest($restRequest);

        if ($companyBusinessUnitAddressListTransfer->getCustomerReference() === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        return $this->restResponseBuilder->buildCompanyBusinessUnitAddressSearchRestResponse(
            $this->client->searchCompanyBusinessUnitAddress($companyBusinessUnitAddressListTransfer),
            $restRequest->getMetadata()->getLocale()
        );
    }
}
