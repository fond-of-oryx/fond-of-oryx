<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutorInterface;
use PHPUnit\Framework\MockObject\MockObject;

class PropelPreMigrationFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationBusinessFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SqlExecutorInterface|MockObject $executorMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationFacade
     */
    protected PropelPreMigrationFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(PropelPreMigrationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->executorMock = $this->getMockBuilder(SqlExecutorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new PropelPreMigrationFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $files = ['bla.sql'];
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSqlExecutor')
            ->willReturn($this->executorMock);

        $this->executorMock->expects(static::atLeastOnce())
            ->method('execute')
            ->with($files)
            ->willReturn([]);

        $this->facade->execute($files);
    }
}
