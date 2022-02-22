<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReaderInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;

class JellyfishCrossEngageFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngageFacade
     */
    protected $jellyfishCrossEngageFacade;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngageBusinessFactory
     */
    protected $jellyfishCrossEngageBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReaderInterface
     */
    protected $jellyfishCrossEngageReaderMock;

    /**
     * @var string
     */
    protected $categories;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->gender = 'male';

        $this->categories = 'category1, category2';

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageBusinessFactoryMock = $this->getMockBuilder(JellyfishCrossEngageBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageReaderMock = $this->getMockBuilder(JellyfishCrossEngageReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageFacade = new JellyfishCrossEngageFacade();
        $this->jellyfishCrossEngageFacade->setFactory($this->jellyfishCrossEngageBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetGender(): void
    {
        $this->jellyfishCrossEngageBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishCrossEngageReader')
            ->willReturn($this->jellyfishCrossEngageReaderMock);

        $this->jellyfishCrossEngageReaderMock->expects($this->atLeastOnce())
            ->method('getGender')
            ->with($this->jellyfishOrderItemTransferMock)
            ->willReturn($this->gender);

        $this->assertSame(
            $this->gender,
            $this->jellyfishCrossEngageFacade->getGender(
                $this->jellyfishOrderItemTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetCategories(): void
    {
        $this->jellyfishCrossEngageBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishCrossEngageReader')
            ->willReturn($this->jellyfishCrossEngageReaderMock);

        $this->jellyfishCrossEngageReaderMock->expects($this->atLeastOnce())
            ->method('getCategories')
            ->with($this->jellyfishOrderItemTransferMock)
            ->willReturn($this->categories);

        $this->assertSame(
            $this->categories,
            $this->jellyfishCrossEngageFacade->getCategories(
                $this->jellyfishOrderItemTransferMock,
            ),
        );
    }
}
