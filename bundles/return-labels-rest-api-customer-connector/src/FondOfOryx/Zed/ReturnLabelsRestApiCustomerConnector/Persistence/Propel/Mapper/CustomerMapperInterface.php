<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;

interface CustomerMapperInterface
{
    public function mapEntityToTransfer(
        SpyCustomer $entity,
        CustomerTransfer $transfer
    ): CustomerTransfer;
}
