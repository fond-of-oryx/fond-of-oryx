<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Mapper;

use Generated\Shared\Transfer\CustomerApiTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerApiMapper implements CustomerApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApiTransfer
     */
    public function fromCustomer(CustomerTransfer $customerTransfer): CustomerApiTransfer
    {
        return (new CustomerApiTransfer())->fromArray($customerTransfer->toArray(), true);
    }
}
