<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class CustomerReferenceGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SequenceNumberSettingsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sequenceNumberSettingsTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->sequenceNumberFacadeMock = $this->getMockBuilder(CustomerRegistrationToSequenceNumberFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(CustomerRegistrationToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CustomerRegistrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sequenceNumberSettingsTransferMock = $this->getMockBuilder(SequenceNumberSettingsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new CustomerReferenceGenerator(
            $this->sequenceNumberFacadeMock,
            $this->storeFacadeMock,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testGenerateCustomerReference(): void
    {
        $this->storeFacadeMock
            ->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock
            ->expects(static::atLeastOnce())
            ->method('getNameOrFail')
            ->willReturn('bar');

        $this->sequenceNumberFacadeMock
            ->expects(static::atLeastOnce())
            ->method('generate')
            ->willReturn('foobar');

        $this->configMock
            ->expects(static::atLeastOnce())
            ->method('getCustomerReferenceDefaults')
            ->willReturn($this->sequenceNumberSettingsTransferMock);

        $this->generator->generateCustomerReference();
    }
}
