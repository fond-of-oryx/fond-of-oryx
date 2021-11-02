<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslatorInterface
     */
    protected $restCompanyBusinessUnitSearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapperInterface
     */
    protected $restCompanyBusinessUnitSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslatorInterface $restCompanyBusinessUnitSearchAttributesTranslator
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchAttributesMapperInterface $restCompanyBusinessUnitSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCompanyBusinessUnitSearchAttributesTranslatorInterface $restCompanyBusinessUnitSearchAttributesTranslator,
        RestCompanyBusinessUnitSearchAttributesMapperInterface $restCompanyBusinessUnitSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCompanyBusinessUnitSearchAttributesTranslator = $restCompanyBusinessUnitSearchAttributesTranslator;
        $this->restCompanyBusinessUnitSearchAttributesMapper = $restCompanyBusinessUnitSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyBusinessUnitSearchRestResponse(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCompanyBusinessUnitSearchAttributesTransfer = $this->restCompanyBusinessUnitSearchAttributesMapper->fromCompanyBusinessUnitList(
            $companyBusinessUnitListTransfer,
        );

        $restCompanyBusinessUnitSearchAttributesTransfer = $this->restCompanyBusinessUnitSearchAttributesTranslator->translate(
            $restCompanyBusinessUnitSearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCompanyBusinessUnitSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompanyBusinessUnitSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH,
            null,
            $restCompanyBusinessUnitSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyBusinessUnitSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompanyBusinessUnitSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
