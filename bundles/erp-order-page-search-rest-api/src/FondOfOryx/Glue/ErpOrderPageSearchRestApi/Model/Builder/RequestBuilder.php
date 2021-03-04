<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
     */
    protected $requestTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer
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
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function addFilterFromRestRequest(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer
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
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function addRequestParameter(
        RestRequestInterface $restRequest,
        string $parameterName = ErpOrderPageSearchRestApiConfig::QUERY_STRING_PARAMETER
    ): ErpOrderPageSearchRequestTransfer {
        $this->requestTransfer->setSearchString($restRequest->getHttpRequest()->query->get($parameterName, ''));

        return $this->requestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function setAllRequestParameters(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer
    {
        $params = $restRequest->getHttpRequest()->query->all();

        if ($restRequest->getPage()) {
            $params[ErpOrderPageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE] = $restRequest->getPage()->getLimit();
            $params[ErpOrderPageSearchRestApiConfig::PARAMETER_NAME_PAGE] = ($restRequest->getPage()->getOffset() / $restRequest->getPage()->getLimit()) + 1;
        }

        return $this->requestTransfer->setRequestParams($params);
    }

    /**
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function createRequest(): ErpOrderPageSearchRequestTransfer
    {
        $this->requestTransfer = new ErpOrderPageSearchRequestTransfer();

        return $this->requestTransfer;
    }
}
