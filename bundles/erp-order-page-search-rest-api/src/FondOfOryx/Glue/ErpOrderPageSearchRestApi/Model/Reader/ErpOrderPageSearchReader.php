<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpOrderPageSearchReader implements ErpOrderPageSearchReaderInterface
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface
     */
    protected $erpOrderPageSearchClient;

    /**
     * ErpOrderPageSearchReader constructor.
     *
     * @param  \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface  $erpOrderPageSearchClient
     */
    public function __construct(ErpOrderPageSearchClientInterface $erpOrderPageSearchClient)
    {
        $this->erpOrderPageSearchClient = $erpOrderPageSearchClient;
    }

    /**
     * @param  \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface  $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findErpOrdersByFilterTransfer(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->createResponse($this->erpOrderPageSearchClient->findErpOrdersByFilterTransfer($this->createRequest($restRequest)));
    }

    /**
     * @param  \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface  $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function createRequest(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer
    {
    }

    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchTransfer  $erpOrderPageSearchTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createResponse(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer): RestResponseInterface
    {
    }
}
