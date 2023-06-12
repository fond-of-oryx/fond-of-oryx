<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator;

use \DateTime;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

class DurationValidator implements DurationValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig $config
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
