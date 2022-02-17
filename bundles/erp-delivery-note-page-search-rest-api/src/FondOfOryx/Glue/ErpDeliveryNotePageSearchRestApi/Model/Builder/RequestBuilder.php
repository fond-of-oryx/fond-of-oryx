<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConfig;
use Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer;
     */
    protected $requestTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpDeliveryNotePageSearchRequestTransfer
    {
        $this->requestTransfer = $this->createRequest();
        $this->requestTransfer->setIncludes($restRequest->getInclude());
        $this->requestTransfer = $this->addFilterFromRestRequest($restRequest);
        $this->requestTransfer = $this->addRequestParameter($restRequest);
        $this->requestTransfer = $this->setAllRequestParameters($restRequest);

        return $this->requestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    protected function addFilterFromRestRequest(RestRequestInterface $restRequest): ErpDeliveryNotePageSearchRequestTransfer
    {
        $filterCollection = [];
        foreach ($restRequest->getFilters() as $filterName => $filter) {
            $filterCollection[$filterName][] = [
                'resource' => $filter->getResource(),
                'value' => $filter->getValue(),
                'field' => $filter->getField(),
            ];
        }
        $this->requestTransfer->setFilters($filterCollection);

        return $this->requestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    protected function addRequestParameter(
        RestRequestInterface $restRequest,
        string $parameterName = ErpDeliveryNotePageSearchRestApiConfig::QUERY_STRING_PARAMETER
    ): ErpDeliveryNotePageSearchRequestTransfer {
        $this->requestTransfer->setSearchString($restRequest->getHttpRequest()->query->get($parameterName, ''));

        return $this->requestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    protected function setAllRequestParameters(RestRequestInterface $restRequest): ErpDeliveryNotePageSearchRequestTransfer
    {
        $params = $restRequest->getHttpRequest()->query->all();

        if ($restRequest->getPage()) {
            $params[ErpDeliveryNotePageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE] = $restRequest->getPage()->getLimit();
            $params[ErpDeliveryNotePageSearchRestApiConfig::PARAMETER_NAME_PAGE] = ($restRequest->getPage()->getOffset() / $restRequest->getPage()->getLimit()) + 1;
        }

        return $this->requestTransfer->setRequestParams($params);
    }

    /**
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer
     */
    protected function createRequest(): ErpDeliveryNotePageSearchRequestTransfer
    {
        $this->requestTransfer = new ErpDeliveryNotePageSearchRequestTransfer();

        return $this->requestTransfer;
    }
}
