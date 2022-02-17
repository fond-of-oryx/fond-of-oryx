<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpDeliveryNotePageSearchReader implements ErpDeliveryNotePageSearchReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
     */
    protected $erpDeliveryNotePageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface
     */
    protected $erpDeliveryNoteMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface $erpDeliveryNotePageSearchClient
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface $requestBuilder
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface $erpDeliveryNoteMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface $erpDeliveryNotePageSearchClient,
        RequestBuilderInterface $requestBuilder,
        ErpDeliveryNoteMapperInterface $erpDeliveryNoteMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->erpDeliveryNotePageSearchClient = $erpDeliveryNotePageSearchClient;
        $this->requestBuilder = $requestBuilder;
        $this->erpDeliveryNoteMapper = $erpDeliveryNoteMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpDeliveryNotesByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        $requestTransfer = $this->requestBuilder->create($restRequest);

        return $this->createResponse($this->erpDeliveryNotePageSearchClient->search(
            $requestTransfer->getSearchString(),
            $requestTransfer->getRequestParams(),
        ));
    }

    /**
     * @param array $response
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse(array $response): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $collection = $this->erpDeliveryNoteMapper->mapErpDeliveryNoteResource($response);
        $resource = $this->restResourceBuilder->createRestResource(
            ErpDeliveryNotePageSearchRestApiConfig::RESOURCE_ERP_DELIVERY_NOTES,
            null,
            $collection,
        );

        $restResponse->addResource($resource);

        return $restResponse;
    }
}
