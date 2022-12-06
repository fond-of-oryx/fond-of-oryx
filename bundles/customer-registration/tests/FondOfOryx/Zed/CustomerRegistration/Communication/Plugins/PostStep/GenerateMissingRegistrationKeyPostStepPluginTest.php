<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PostStep;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacade;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class GenerateMissingRegistrationKeyPostStepPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $attributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GenerateMissingRegistrationKeyPostStepPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBagOrFail')->willReturn($this->bagTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getAttributes')->willReturn($this->attributesTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('setBag')->willReturnSelf();
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('setAttributes')->willReturnSelf();
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getRegistrationKey')->willReturn(null);
        $this->facadeMock->expects(static::atLeastOnce())->method('generateToken')->willReturn('token');
        $this->facadeMock->expects(static::atLeastOnce())->method('saveRegistrationKeyToCustomer')->willReturn($this->customerTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getAcceptGdpr')->willReturn(true);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getRegistrationKey')->willReturn('token');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
