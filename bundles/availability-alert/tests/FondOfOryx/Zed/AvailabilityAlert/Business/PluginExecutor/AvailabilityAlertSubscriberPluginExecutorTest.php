<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPreSavePluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

class AvailabilityAlertSubscriberPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransfer;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->preSavePluginMock = static::getMockBuilder(AvailabilityAlertSubscriberPreSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->postSavePluginMock = static::getMockBuilder(AvailabilityAlertSubscriberPostSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransfer = static::getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->preSavePluginMock->expects(static::exactly(2))->method('preSave')->willReturn($this->subscriberTransfer);
        $this->postSavePluginMock->expects(static::never())->method('postSave');
        $expander = new AvailabilityAlertSubscriberPluginExecutor([$this->preSavePluginMock, $this->preSavePluginMock], [$this->postSavePluginMock, $this->postSavePluginMock]);
        $response = $expander->executePreSavePlugins($this->subscriberTransfer);
        static::assertInstanceOf(AvailabilityAlertSubscriberTransfer::class, $response);
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects(static::exactly(2))->method('postSave')->willReturn($this->subscriberTransfer);
        $this->preSavePluginMock->expects(static::never())->method('preSave');
        $expander = new AvailabilityAlertSubscriberPluginExecutor([$this->preSavePluginMock, $this->preSavePluginMock], [$this->postSavePluginMock, $this->postSavePluginMock]);
        $response = $expander->executePostSavePlugins($this->subscriberTransfer);
        static::assertInstanceOf(AvailabilityAlertSubscriberTransfer::class, $response);
    }
}
