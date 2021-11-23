<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer;
     */
    protected $requestTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpInvoicePageSearchRequestTransfer
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
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    protected function addFilterFromRestRequest(RestRequestInterface $restRequest): ErpInvoicePageSearchRequestTransfer
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
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    protected function addRequestParameter(
        RestRequestInterface $restRequest,
        string $parameterName = ErpInvoicePageSearchRestApiConfig::QUERY_STRING_PARAMETER
    ): ErpInvoicePageSearchRequestTransfer {
        $this->requestTransfer->setSearchString($restRequest->getHttpRequest()->query->get($parameterName, ''));

        return $this->requestTransfer;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    protected function setAllRequestParameters(RestRequestInterface $restRequest): ErpInvoicePageSearchRequestTransfer
    {
        $params = $restRequest->getHttpRequest()->query->all();

        if ($restRequest->getPage()) {
            $params[ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE] = $restRequest->getPage()->getLimit();
            $params[ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_PAGE] = ($restRequest->getPage()->getOffset() / $restRequest->getPage()->getLimit()) + 1;
        }

        return $this->requestTransfer->setRequestParams($params);
    }

    /**
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    protected function createRequest(): ErpInvoicePageSearchRequestTransfer
    {
        $this->requestTransfer = new ErpInvoicePageSearchRequestTransfer();

        return $this->requestTransfer;
    }
}
