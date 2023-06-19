<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service;

interface RepresentativeCompanyUserToUtilDateTimeServiceInterface
{
    /**
     * Specification:
     * - Formats a given datetime string into a configured datetime
     *
     * @api
     *
     * @param \DateTime|string $date
     *
     * @return string
     */
    public function formatDateTime($date): string;
}
