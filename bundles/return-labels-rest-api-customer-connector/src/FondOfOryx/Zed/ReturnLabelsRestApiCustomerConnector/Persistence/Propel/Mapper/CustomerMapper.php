<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\Propel\Mapper;


use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;

class CustomerMapper implements CustomerMapperInterface
{
    public function mapEntityToTransfer(
        SpyCustomer $entity,
        CustomerTransfer $transfer
    ): CustomerTransfer {
        return $transfer->fromArray($entity->toArray(), true);
    }
}
