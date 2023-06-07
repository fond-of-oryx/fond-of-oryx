<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Validator;

use \DateTime;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

class DurationValidator implements DurationValidatorInterface
{
    /**
     * @var \Spryker\Glue\CartsRestApi\CartsRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig $config
     */
    public function __construct(RepresentativeCompanyUserTradeFairRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransfer
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validate(
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransfer
    ): bool {
        $startAtDateTime = new DateTime($restRepresentativeCompanyUserTradeFairAttributesTransfer->getStartAt());
        $endAtDateTime = new DateTime($restRepresentativeCompanyUserTradeFairAttributesTransfer->getEndAt());

        if ($startAtDateTime->diff($endAtDateTime)->format('%d') > $this->config->getMaxDurationForRepresentation()) {
            return false;
        }

        return true;
    }

}
