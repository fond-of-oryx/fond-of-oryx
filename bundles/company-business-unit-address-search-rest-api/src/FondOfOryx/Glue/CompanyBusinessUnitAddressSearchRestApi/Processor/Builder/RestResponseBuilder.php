<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface $restCompanyBusinessUnitAddressSearchAttributesTranslator
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface $restCompanyBusinessUnitAddressSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface $restCompanyBusinessUnitAddressSearchAttributesTranslator,
        RestCompanyBusinessUnitAddressSearchAttributesMapperInterface $restCompanyBusinessUnitAddressSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCompanyBusinessUnitAddressSearchAttributesTranslator = $restCompanyBusinessUnitAddressSearchAttributesTranslator;
        $this->restCompanyBusinessUnitAddressSearchAttributesMapper = $restCompanyBusinessUnitAddressSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyBusinessUnitAddressSearchRestResponse(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCompanyBusinessUnitAddressSearchAttributesTransfer = $this->restCompanyBusinessUnitAddressSearchAttributesMapper->fromCompanyBusinessUnitAddressList(
            $companyBusinessUnitAddressListTransfer,
        );

        $restCompanyBusinessUnitAddressSearchAttributesTransfer = $this->restCompanyBusinessUnitAddressSearchAttributesTranslator->translate(
            $restCompanyBusinessUnitAddressSearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCompanyBusinessUnitAddressSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompanyBusinessUnitAddressSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH,
            null,
            $restCompanyBusinessUnitAddressSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyBusinessUnitAddressSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompanyBusinessUnitAddressSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
