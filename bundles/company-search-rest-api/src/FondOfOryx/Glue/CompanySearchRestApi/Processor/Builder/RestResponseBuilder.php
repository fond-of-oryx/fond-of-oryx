<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface
     */
    protected $restCompanySearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface
     */
    protected $restCompanySearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface $restCompanySearchAttributesTranslator
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface $restCompanySearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCompanySearchAttributesTranslatorInterface $restCompanySearchAttributesTranslator,
        RestCompanySearchAttributesMapperInterface $restCompanySearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCompanySearchAttributesTranslator = $restCompanySearchAttributesTranslator;
        $this->restCompanySearchAttributesMapper = $restCompanySearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanySearchRestResponse(
        CompanyListTransfer $companyListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCompanySearchAttributesTransfer = $this->restCompanySearchAttributesMapper->fromCompanyList(
            $companyListTransfer,
        );

        $restCompanySearchAttributesTransfer = $this->restCompanySearchAttributesTranslator->translate(
            $restCompanySearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCompanySearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompanySearchRestApiConfig::RESOURCE_COMPANY_SEARCH,
            null,
            $restCompanySearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanySearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompanySearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
