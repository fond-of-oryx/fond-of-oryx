<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;

class RepresentativeCompanyUserTradeFairRestApiStub implements RepresentativeCompanyUserTradeFairRestApiStubInterface
{
    /**
     * @var string
     */
    public const ADD_TRADE_FAIR_REPRESENTATION = '/representative-company-user-trade-fair-rest-api/gateway/add-trade-fair-representation';

    /**
     * @var string
     */
    public const GET_TRADE_FAIR_REPRESENTATION = '/representative-company-user-trade-fair-rest-api/gateway/get-trade-fair-representation';

    /**
     * @var string
     */
    public const PATCH_TRADE_FAIR_REPRESENTATION = '/representative-company-user-trade-fair-rest-api/gateway/patch-trade-fair-representation';

    /**
     * @var string
     */
    public const DELETE_TRADE_FAIR_REPRESENTATION = '/representative-company-user-trade-fair-rest-api/gateway/delete-trade-fair-representation';

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function addTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairRestResponseTransfer */
        $representativeCompanyUserTradeFairRestResponseTransfer = $this
            ->zedRequestClient->call(
                static::ADD_TRADE_FAIR_REPRESENTATION,
                $restRepresentativeCompanyUserTradeFairRequestTransfer,
            );

        return $representativeCompanyUserTradeFairRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function getTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairRestResponseTransfer */
        $representativeCompanyUserTradeFairRestResponseTransfer = $this
            ->zedRequestClient->call(
                static::GET_TRADE_FAIR_REPRESENTATION,
                $restRepresentativeCompanyUserTradeFairRequestTransfer,
            );

        return $representativeCompanyUserTradeFairRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function patchTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairRestResponseTransfer */
        $representativeCompanyUserTradeFairRestResponseTransfer = $this->zedRequestClient->call(static::PATCH_TRADE_FAIR_REPRESENTATION, $restRepresentativeCompanyUserTradeFairRequestTransfer);

        return $representativeCompanyUserTradeFairRestResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function deleteTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairRestResponseTransfer */
        $representativeCompanyUserTradeFairRestResponseTransfer = $this->zedRequestClient->call(static::DELETE_TRADE_FAIR_REPRESENTATION, $restRepresentativeCompanyUserTradeFairRequestTransfer);

        return $representativeCompanyUserTradeFairRestResponseTransfer;
    }
}
