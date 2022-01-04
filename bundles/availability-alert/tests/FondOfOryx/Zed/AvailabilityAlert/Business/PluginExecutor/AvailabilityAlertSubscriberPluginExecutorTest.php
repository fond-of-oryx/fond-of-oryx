<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface;
use FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertSubscriberPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransfer;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransfer;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->preSavePluginMock = $this->getMockBuilder(AvailabilityAlertSubscriberPreSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->postSavePluginMock = $this->getMockBuilder(AvailabilityAlertSubscriberPostSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransfer = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransfer = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->preSavePluginMock->expects(static::exactly(2))->method('preSave')->willReturn($this->subscriberTransfer);
        $this->postSavePluginMock->expects(static::never())->method('postSave');
        $expander = new AvailabilityAlertSubscriberPluginExecutor([$this->preSavePluginMock, $this->preSavePluginMock], [$this->postSavePluginMock, $this->postSavePluginMock]);
        $response = $expander->executePreSavePlugins($this->subscriberTransfer, $this->subscriptionTransfer);
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
        $response = $expander->executePostSavePlugins($this->subscriberTransfer, $this->subscriptionTransfer);
        static::assertInstanceOf(AvailabilityAlertSubscriberTransfer::class, $response);
    }
}
