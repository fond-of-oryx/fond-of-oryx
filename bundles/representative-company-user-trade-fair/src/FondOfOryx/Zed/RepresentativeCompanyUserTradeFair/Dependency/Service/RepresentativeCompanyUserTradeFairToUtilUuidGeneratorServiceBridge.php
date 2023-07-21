<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service;

use Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface;

class RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceBridge implements RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface
{
    /**
     * @var \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected $service;

    /**
     * @param \Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface $uuidService
     */
    public function __construct(UtilUuidGeneratorServiceInterface $uuidService)
    {
        $this->service = $uuidService;
    }

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
    public function generateUuid5FromObjectId(string $name): string
    {
        return $this->service->generateUuid5FromObjectId($name);
    }
}
