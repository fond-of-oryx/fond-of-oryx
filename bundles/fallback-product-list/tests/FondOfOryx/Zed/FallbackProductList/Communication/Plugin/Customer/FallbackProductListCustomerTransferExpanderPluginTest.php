<?php

namespace FondOfOryx\Zed\FallbackProductList\Communication\Plugin\Customer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackProductList\FallbackProductListConfig;
use Generated\Shared\Transfer\CustomerProductListCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class FallbackProductListCustomerTransferExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\FallbackProductList\FallbackProductListConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackProductList\Communication\Plugin\Customer\FallbackProductListCustomerTransferExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(FallbackProductListConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListCollectionTransferMock = $this->getMockBuilder(CustomerProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new FallbackProductListCustomerTransferExpanderPlugin();
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpandTransfer(): void
    {
        $fallbackWhitelistIds = [1];
        $fallbackBlacklistIds = [2];

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerProductListCollection')
            ->willReturn($this->customerProductListCollectionTransferMock);

        $this->customerTransferMock->expects(static::never())
            ->method('setCustomerProductListCollection');

        $this->customerProductListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistIds')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackBlacklistIds')
            ->willReturn($fallbackBlacklistIds);

        $this->customerProductListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistIds')
            ->willReturn($fallbackBlacklistIds);

        $this->customerProductListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getWhitelistIds')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackWhitelistIds')
            ->willReturn($fallbackWhitelistIds);

        $this->customerProductListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setWhitelistIds')
            ->willReturn($fallbackWhitelistIds);

        static::assertEquals(
            $this->customerTransferMock,
            $this->plugin->expandTransfer($this->customerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandTransferWithNullableCustomerProductListCollection(): void
    {
        $fallbackWhitelistIds = [1];
        $fallbackBlacklistIds = [2];

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerProductListCollection')
            ->willReturn(null);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackBlacklistIds')
            ->willReturn($fallbackBlacklistIds);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackWhitelistIds')
            ->willReturn($fallbackWhitelistIds);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerProductListCollection')
            ->with(
                static::callback(
                    static function (
                        CustomerProductListCollectionTransfer $customerProductListCollectionTransfer
                    ) use (
                        $fallbackWhitelistIds,
                        $fallbackBlacklistIds
                    ) {
                        return $customerProductListCollectionTransfer->getBlacklistIds() === $fallbackBlacklistIds
                            && $customerProductListCollectionTransfer->getWhitelistIds() === $fallbackWhitelistIds;
                    },
                ),
            )->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->plugin->expandTransfer($this->customerTransferMock),
        );
    }
}
