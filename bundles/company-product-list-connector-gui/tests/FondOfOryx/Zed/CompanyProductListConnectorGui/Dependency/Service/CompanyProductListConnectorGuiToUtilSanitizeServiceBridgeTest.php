<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilSanitize\UtilSanitizeServiceInterface;

class CompanyProductListConnectorGuiToUtilSanitizeServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilSanitize\UtilSanitizeServiceInterface
     */
    protected $serviceMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service\CompanyProductListConnectorGuiToUtilSanitizeServiceBridge
     */
    protected $serviceBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilSanitizeServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceBridge = new CompanyProductListConnectorGuiToUtilSanitizeServiceBridge($this->serviceMock);
    }

    /**
     * @return void
     */
    public function testEscapeHtml(): void
    {
        $html = '<a href="mailto:foo@bar.com">foo</a>';
        $escapedHtml = '&lt;a href=&quot;mailto:foo@bar.com&quot;&gt;foo&lt;/a&gt;';

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('escapeHtml')
            ->with($html, true, null)
            ->willReturn($escapedHtml);

        static::assertEquals(
            $escapedHtml,
            $this->serviceBridge->escapeHtml($html),
        );
    }
}
