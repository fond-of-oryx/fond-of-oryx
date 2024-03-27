<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer
    {
        $requestTransfer = $this->createRequest();
        $requestTransfer->setIncludes($restRequest->getInclude());
        $requestTransfer = $this->addFilterFromRestRequest($restRequest, $requestTransfer);
        $requestTransfer = $this->addRequestParameter($restRequest, $requestTransfer);

        return $this->setAllRequestParameters($restRequest, $requestTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function addFilterFromRestRequest(
        RestRequestInterface $restRequest,
        ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer
    ): ErpOrderPageSearchRequestTransfer {
        $filterCollection = [];
        foreach ($restRequest->getFilters() as $filterName => $filter) {
            $filterCollection[$filterName][] = [
                'resource' => $filter->getResource(),
                'value' => $filter->getValue(),
                'field' => $filter->getField(),
            ];
        }
        $erpOrderPageSearchRequestTransfer->setFilters($filterCollection);

        return $erpOrderPageSearchRequestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer
     * @param string $parameterName
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function addRequestParameter(
        RestRequestInterface $restRequest,
        ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer,
        string $parameterName = ErpOrderPageSearchRestApiConfig::QUERY_STRING_PARAMETER
    ): ErpOrderPageSearchRequestTransfer {
        $erpOrderPageSearchRequestTransfer->setSearchString($restRequest->getHttpRequest()->query->get($parameterName, ''));

        return $erpOrderPageSearchRequestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function setAllRequestParameters(
        RestRequestInterface $restRequest,
        ErpOrderPageSearchRequestTransfer $erpOrderPageSearchRequestTransfer
    ): ErpOrderPageSearchRequestTransfer {
        $params = $restRequest->getHttpRequest()->query->all();

        if ($restRequest->getPage()) {
            $params[ErpOrderPageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE] = $restRequest->getPage()->getLimit();
            $params[ErpOrderPageSearchRestApiConfig::PARAMETER_NAME_PAGE] = ($restRequest->getPage()->getOffset() / $restRequest->getPage()->getLimit()) + 1;
        }

        return $erpOrderPageSearchRequestTransfer->setRequestParams($params);
    }

    /**
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    protected function createRequest(): ErpOrderPageSearchRequestTransfer
    {
        return new ErpOrderPageSearchRequestTransfer();
    }
}
