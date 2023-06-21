<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator;

use DateTime;
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
     */
    public function validate(
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransfer
    ): bool {
        $startAt = $restRepresentativeCompanyUserTradeFairAttributesTransfer->getStartAt();
        $endAt = $restRepresentativeCompanyUserTradeFairAttributesTransfer->getEndAt();

        if (!$startAt || !$endAt) {
            return false;
        }

        $startAtDateTime = new DateTime($startAt);
        $endAtDateTime = new DateTime($endAt);

        if ($startAtDateTime->diff($endAtDateTime)->days > $this->config->getMaxDurationForRepresentation()) {
            return false;
        }

        return true;
    }
}
