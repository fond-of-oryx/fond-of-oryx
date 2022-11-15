<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Service;

use Spryker\Service\UtilText\UtilTextServiceInterface;

class CustomerRegistrationToUtilTextServiceBridge implements CustomerRegistrationToUtilTextServiceInterface
{
    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $service;

    /**
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $utilTextService
     */
    public function __construct(UtilTextServiceInterface $utilTextService)
    {
        $this->service = $utilTextService;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString(int $length): string
    {
        return $this->service->generateRandomString($length);
    }
}
