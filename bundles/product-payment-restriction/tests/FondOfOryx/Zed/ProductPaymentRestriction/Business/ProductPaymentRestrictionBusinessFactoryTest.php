<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository;

class ProductPaymentRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductPaymentRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ProductPaymentRestrictionBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductPaymentRestrictionPaymentMethodFilter(): void
    {
        static::assertInstanceOf(
            ProductPaymentRestrictionPaymentMethodFilter::class,
            $this->businessFactory->createProductPaymentRestrictionPaymentMethodFilter(),
        );
    }
}
