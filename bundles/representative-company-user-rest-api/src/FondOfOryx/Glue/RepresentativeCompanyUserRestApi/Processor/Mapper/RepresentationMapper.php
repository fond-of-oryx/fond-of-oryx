<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterPageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterSortTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
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
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer
     */
    public function createRequest(
        RestRequestInterface $restRequest,
        ?RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer = null
    ): RestRepresentativeCompanyUserRequestTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createAttributesFromRequest($restRequest);
        }

        return (new RestRepresentativeCompanyUserRequestTransfer())
            ->setAttributes($attributesTransfer)
            ->setFilter($this->createFilterFromRequest($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer
     */
    public function createAttributesFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserAttributesTransfer
    {
        $data = $restRequest->getAttributesDataFromRequest();
        if ($data === null) {
            $data = [];
        }

        return (new RestRepresentativeCompanyUserAttributesTransfer())
            ->fromArray($data, true)
            ->setUuid($this->getUuid($restRequest))
            ->setReferenceOriginator($this->getOriginatorCustomerUserReference($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterTransfer
     */
    public function createFilterFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserFilterTransfer
    {
        $queryData = $restRequest->getHttpRequest()->query;
        $data = [];
        if ($queryData->count() > 0) {
            $data = $queryData->all();
            unset($data['page'], $data['sort']);
        }

        return (new RestRepresentativeCompanyUserFilterTransfer())
            ->fromArray($data, true)
            ->setSort($this->recreateSortFilter($restRequest))
            ->setPage($this->recreatePageFilter($restRequest));
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
     * @return \ArrayObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterSortTransfer[]
     */
    public function recreateSortFilter(RestRequestInterface $restRequest): ArrayObject
    {
        $sortFilter = new ArrayObject();

        foreach ($restRequest->getSort() as $index => $sort) {
            $override = explode('_', $sort->getField());
            $direction = strtoupper(array_pop($override));
            $sortTransfer = (new RestRepresentativeCompanyUserFilterSortTransfer())
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
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserFilterPageTransfer|null
     */
    public function recreatePageFilter(RestRequestInterface $restRequest): ?RestRepresentativeCompanyUserFilterPageTransfer
    {
        $page = $restRequest->getPage();
        if ($page === null) {
            return null;
        }

        return (new RestRepresentativeCompanyUserFilterPageTransfer())
            ->setLimit($page->getLimit())
            ->setOffset($page->getOffset());
    }
}
