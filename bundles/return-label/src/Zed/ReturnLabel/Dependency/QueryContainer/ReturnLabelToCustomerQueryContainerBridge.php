<?php


namespace FondOfOryx\Zed\ReturnLabel\Dependency\QueryContainer;


use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class ReturnLabelToCustomerQueryContainerBridge implements ReturnLabelToCustomerQueryContainerInterface
{
    protected $customerQueryContainer;

    public function __construct(CustomerQueryContainerInterface $customerQueryContainer)
    {
        $this->customerQueryContainer = $customerQueryContainer;
    }


}
