<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapperInterface
     */
    protected $restCompanyRoleSearchAttributesMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslatorInterface
     */
    protected $restCompanyUserSearchAttributesTranslator;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslatorInterface $restCompanyUserSearchAttributesTranslator
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapperInterface $restCompanyRoleSearchAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestCompanyRoleSearchAttributesTranslatorInterface $restCompanyUserSearchAttributesTranslator,
        RestCompanyRoleSearchAttributesMapperInterface $restCompanyRoleSearchAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restCompanyUserSearchAttributesTranslator = $restCompanyUserSearchAttributesTranslator;
        $this->restCompanyRoleSearchAttributesMapper = $restCompanyRoleSearchAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyRoleSearchRestResponse(
        CompanyRoleListTransfer $companyRoleListTransfer,
        string $locale
    ): RestResponseInterface {
        $restCompanyRoleSearchAttributesTransfer =
            $this->restCompanyRoleSearchAttributesMapper->fromCompanyRoleList($companyRoleListTransfer);

        $restCompanyRoleSearchAttributesTransfer = $this->restCompanyUserSearchAttributesTranslator
            ->translate($restCompanyRoleSearchAttributesTransfer, $locale);

        $restResponse = $this->restResourceBuilder->createRestResponse(
            $restCompanyRoleSearchAttributesTransfer->getPagination()->getNumFound(),
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompanyRoleSearchRestApiConfig::RESOURCE_COMPANY_ROLE_SEARCH,
            null,
            $restCompanyRoleSearchAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyRoleSearchRestApiConfig::RESPONSE_CODE_CUSTOMER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompanyRoleSearchRestApiConfig::ERROR_MESSAGE_CUSTOMER_IS_NOT_SPECIFIED);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
