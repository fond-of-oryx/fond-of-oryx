<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Mapper;

use Generated\Shared\Transfer\CustomerApiTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerApiTransfer
     */
    public function fromCustomer(CustomerTransfer $customerTransfer): CustomerApiTransfer;
}
