<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacade;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;

class CheckForActivationTaskCommandPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFilterTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\CheckForActivationTaskCommandPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(RepresentativeCompanyUserFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFilterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CheckForActivationTaskCommandPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $this->facadeMock
            ->expects(static::atLeastOnce())
            ->method('runTask');
        $this->plugin->run($this->representativeCompanyUserFilterTransferMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertSame('CheckForActivation', $this->plugin->getName());
    }
}
