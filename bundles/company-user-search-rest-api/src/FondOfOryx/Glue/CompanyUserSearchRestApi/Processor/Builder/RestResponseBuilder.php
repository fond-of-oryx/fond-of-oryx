<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface
     */
    protected $restCompanyUserSearchAttributesTranslator;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface
     */
    protected $restCompanyUserSearchAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface $restCompanyUserSearchAttributesTranslator
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface $restCompanyUserSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCompanyUserSearchAttributesTranslatorInterface $restCompanyUserSearchAttributesTranslator,
        RestCompanyUserSearchAttributesMapperInterface $restCompanyUserSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCompanyUserSearchAttributesTranslator = $restCompanyUserSearchAttributesTranslator;
        $this->restCompanyUserSearchAttributesMapper = $restCompanyUserSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyUserSearchRestResponse(
        CompanyUserListTransfer $companyUserListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCompanyUserSearchAttributesTransfer = $this->restCompanyUserSearchAttributesMapper->fromCompanyUserList(
            $companyUserListTransfer,
        );

        $restCompanyUserSearchAttributesTransfer = $this->restCompanyUserSearchAttributesTranslator->translate(
            $restCompanyUserSearchAttributesTransfer,
            $locale,
        );

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCompanyUserSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompanyUserSearchRestApiConfig::RESOURCE_COMPANY_USER_SEARCH,
            null,
            $restCompanyUserSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyUserSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompanyUserSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
