<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface;
use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginExecutorMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleter
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->companyFacadeMock = $this->getMockBuilder(CompanyDeleterToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(PluginExecutorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyDeleter(
            $this->companyFacadeMock,
            $this->transactionHandlerMock,
            $this->pluginExecutorMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())->method('executePreDeletePlugins');
        $this->pluginExecutorMock->expects(static::atLeastOnce())->method('executePostDeletePlugins');
        $this->companyFacadeMock->expects(static::atLeastOnce())->method('delete');
        $this->transactionHandlerMock->expects(static::atLeastOnce())->method('handleTransaction')->willReturnCallback(static function (callable $callable) {
            return call_user_func($callable);
        });

        $result = $this->model->delete([1]);
        static::assertSame($result[CompanyDeleterConstants::SUCCESS_IDS][0], 1);
    }

    /**
     * @return void
     */
    public function testDeleteThrowsException()
    {
        $this->loggerMock->expects(static::atLeastOnce())->method('error');
        $this->transactionHandlerMock->expects(static::atLeastOnce())->method('handleTransaction')->willReturnCallback(static function (callable $callable) {
            throw new Exception();
        });

        $result = $this->model->delete([1]);
        static::assertSame($result[CompanyDeleterConstants::ERROR_IDS][0], 1);
    }
}
