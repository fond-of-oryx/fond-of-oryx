<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

class CustomerRegistrationRestApiStub implements CustomerRegistrationRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface
     */
    protected $zedStub;

    /**
     * @param \FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface $zedStub
     */
    public function __construct(CustomerRegistrationRestApiToZedRequestClientInterface $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function handleCustomerRegistrationRequest(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationResponseTransfer {
        /** @var \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer $customerRegistrationResponseTransfer */
        $customerRegistrationResponseTransfer = $this->zedStub->call(
            '/customer-registration/gateway/register-customer',
            $customerRegistrationRequestTransfer,
        );

        return $customerRegistrationResponseTransfer;
    }
}
