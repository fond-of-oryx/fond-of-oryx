<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Executor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface;
use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class PluginExecutorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $prePluginMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postPluginMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutor
     */
    protected $executor;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->prePluginMock = $this->getMockBuilder(CompanyDeleterPreDeletePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postPluginMock = $this->getMockBuilder(CompanyDeleterPostDeletePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->executor = new PluginExecutor(
            [
                $this->prePluginMock,
            ],
            [
                $this->postPluginMock,
            ],
        );
    }

    /**
     * @return void
     */
    public function testExecutePreDeletePlugins()
    {
        $this->prePluginMock->expects(static::atLeastOnce())->method('execute');

        $this->executor->executePreDeletePlugins($this->companyTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePostDeletePlugins()
    {
        $this->postPluginMock->expects(static::atLeastOnce())->method('execute');

        $this->executor->executePostDeletePlugins($this->companyTransferMock);
    }
}
