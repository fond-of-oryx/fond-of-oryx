<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\PropelPreMigration\PropelPreMigrationConstants;
use FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationBusinessFactory;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManager;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepository;
use FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class SqlExecutorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationBusinessFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationRepository|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationEntityManager|MockObject $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PropelPreMigrationConfig|MockObject $configMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected TransactionHandlerInterface|MockObject $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutor
     */
    protected SqlExecutor $executor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(PropelPreMigrationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(PropelPreMigrationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(PropelPreMigrationEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(PropelPreMigrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->executor = new SqlExecutor(
            $this->entityManagerMock,
            $this->repositoryMock,
            $this->configMock,
            $this->transactionHandlerMock,
        );
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $file = '20230908_01.sql';
        $files = [
            0 => $file,
        ];
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getNotMigratedFileNamesByFileNames')
            ->willReturn($files);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('executePlainSqlFromFile')
            ->willReturn(true);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createPropelPreMigrationEntry');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSqlDirectory')
            ->willReturn(__DIR__ . '/../../../../../_data/pre-migrations/');

        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            return $callable();
        });

        $results = $this->executor->execute($files);

        static::assertCount(1, $results);
        static::assertTrue($results[0][PropelPreMigrationConstants::KEY_SUCCESS]);
        static::assertSame($results[0][PropelPreMigrationConstants::KEY_FILE], $file);
    }

    /**
     * @return void
     */
    public function testExecuteWillFail(): void
    {
        $file = '20230908_01.sql';
        $files = [
            0 => $file,
        ];
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getNotMigratedFileNamesByFileNames')
            ->willReturn($files);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('executePlainSqlFromFile')
            ->willThrowException((new Exception('FAIL')));

        $this->entityManagerMock->expects(static::never())
            ->method('createPropelPreMigrationEntry');

        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            return $callable();
        });

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSqlDirectory')
            ->willReturn(__DIR__ . '/../../../../../_data/pre-migrations/');

        $exception = null;
        $results = [];
        try {
            $results = $this->executor->execute($files);
        } catch (Throwable $throwable) {
            $exception = $throwable;
        }

        static::assertEmpty($results);
        static::assertInstanceOf(Throwable::class, $exception);
        static::assertSame($exception->getMessage(), 'Could not execute SQL of "20230908_01.sql". Message: FAIL');
    }
}
