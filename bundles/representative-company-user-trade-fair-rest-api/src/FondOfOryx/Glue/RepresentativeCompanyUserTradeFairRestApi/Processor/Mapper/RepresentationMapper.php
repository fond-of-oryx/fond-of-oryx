<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterPageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterSortTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\SortInterface;
use Symfony\Component\HttpFoundation\Request;

class RepresentationMapper implements RepresentationMapperInterface
{
    /**
     * @var array
     */
    protected const UUID_METHODS = [
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
        Request::METHOD_GET,
    ];

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    public function createRequest(
        RestRequestInterface $restRequest,
        ?RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer = null
    ): RestRepresentativeCompanyUserTradeFairRequestTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createAttributesFromRequest($restRequest);
        }

        return (new RestRepresentativeCompanyUserTradeFairRequestTransfer())
            ->setAttributes($attributesTransfer)
            ->setFilter($this->createFilterFromRequest($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer
     */
    public function createAttributesFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserTradeFairAttributesTransfer
    {
        $data = $restRequest->getAttributesDataFromRequest();
        if ($data === null) {
            $data = [];
        }

        return (new RestRepresentativeCompanyUserTradeFairAttributesTransfer())
            ->fromArray($data, true)
            ->setUuid($this->getUuid($restRequest))
            ->setCustomerReferenceOriginator($this->getOriginatorCustomerUserReference($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getOriginatorCustomerUserReference(RestRequestInterface $restRequest): ?string
    {
        return $restRequest->getRestUser()->getNaturalIdentifier();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getUuid(RestRequestInterface $restRequest): ?string
    {
        $meta = $restRequest->getMetadata();
        if (in_array($meta->getMethod(), static::UUID_METHODS, true)) {
            return $restRequest->getResource()->getId();
        }

        return null;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterTransfer
     */
    public function createFilterFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserTradeFairFilterTransfer
    {
        $queryData = $restRequest->getHttpRequest()->query;
        $data = [];
        if ($queryData->count() > 0) {
            $data = $queryData->all();
            unset($data['page'], $data['sort']);
        }

        return (new RestRepresentativeCompanyUserTradeFairFilterTransfer())
            ->fromArray($data, true)
            ->setSort($this->recreateSortFilter($restRequest))
            ->setPage($this->recreatePageFilter($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterSortTransfer>
     */
    public function recreateSortFilter(RestRequestInterface $restRequest): ArrayObject
    {
        $sortFilter = new ArrayObject();

        foreach ($restRequest->getSort() as $index => $sort) {
            $override = explode('_', $sort->getField());
            $direction = strtoupper(array_pop($override));
            $sortTransfer = (new RestRepresentativeCompanyUserTradeFairFilterSortTransfer())
                ->setField($sort->getField())
                ->setDirection($sort->getDirection());

            if ($direction === SortInterface::SORT_ASC || $direction === SortInterface::SORT_DESC) {
                $sortTransfer
                    ->setField(implode('_', $override))
                    ->setDirection($direction);
            }

            $sortFilter->append($sortTransfer);
        }

        return $sortFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairFilterPageTransfer|null
     */
    public function recreatePageFilter(RestRequestInterface $restRequest): ?RestRepresentativeCompanyUserTradeFairFilterPageTransfer
    {
        $page = $restRequest->getPage();
        if ($page === null) {
            return null;
        }

        return (new RestRepresentativeCompanyUserTradeFairFilterPageTransfer())
            ->setLimit($page->getLimit())
            ->setOffset($page->getOffset());
    }
}
