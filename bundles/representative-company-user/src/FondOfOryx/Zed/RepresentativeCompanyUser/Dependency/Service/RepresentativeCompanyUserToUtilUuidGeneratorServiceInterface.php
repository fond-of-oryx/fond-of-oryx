<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service;

interface RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface
{
    /**
     * Specification:
     * - generates UUID version 5 basing on given resource name and OID namespace.
     *
     * @api
     *
     * @param string $name
     *
     * @return string
     */
    public function generateUuid5FromObjectId(string $name): string;
}
