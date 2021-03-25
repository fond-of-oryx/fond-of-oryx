<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ReturnLabelProcessor implements ReturnLabelProcessorInterface
{
    /**
     * @var ReturnLabelsRestApiClientInterface
     */
    protected $client;

    /**
     * @param ReturnLabelsRestApiClientInterface $client
     */
    public function __construct(ReturnLabelsRestApiClientInterface $client)
    {
        $this->client = $client;
    }

    public function getReturnLabel(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): void
    {
        $returnLabelsRestApiTransfer = $this->createReturnLabelsRestApiTransfer(
            $restRequest, $restReturnLabelRequestAttributesTransfer
        );

        $companyUnitAddressTransfer = $this->hasPermissionsToReadCompanyUnitAddress($returnLabelsRestApiTransfer);
    }

    /**
     * @param string $uuid
     * @param RestUserTransfer $restUserTransfer
     */
    protected function hasPermissionsToReadCompanyUnitAddress(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer
    {
        $companyUnitAddressTransfer = $this->client->findCompanyUnitAddressByUuid($returnLabelsRestApiTransfer);

        if ($companyUnitAddressTransfer === null) {
            return null;
        }

        return $companyUnitAddressTransfer;
    }

    protected function createReturnLabelsRestApiTransfer(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): ReturnLabelsRestApiTransfer
    {
        return (new ReturnLabelsRestApiTransfer())
            ->setRestUserNaturalIndetifier($restRequest->getRestUser()->getNaturalIdentifier())
            ->setCustomerId($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyUnitAddressUuid($restReturnLabelRequestAttributesTransfer->getCompanyUnitAddressUuid());
    }
}
