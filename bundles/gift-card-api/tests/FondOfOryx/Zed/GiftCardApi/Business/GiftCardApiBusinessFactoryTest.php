<?php

namespace FondOfOryx\Zed\GiftCardApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApiInterface;
use FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidatorInterface;
use FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepository;

class GiftCardApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiBusinessFactory
     */
    protected $factory;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(GiftCardApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GiftCardApiBusinessFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardApi(): void
    {
        static::assertInstanceOf(
            GiftCardApiInterface::class,
            $this->factory->createGiftCardApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardApiValidator(): void
    {
        static::assertInstanceOf(
            GiftCardApiValidatorInterface::class,
            $this->factory->createGiftCardApiValidator(),
        );
    }
}
