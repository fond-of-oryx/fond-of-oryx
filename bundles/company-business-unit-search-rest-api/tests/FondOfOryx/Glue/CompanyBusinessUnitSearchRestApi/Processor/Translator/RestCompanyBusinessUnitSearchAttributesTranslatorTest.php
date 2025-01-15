<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer;

class RestCompanyBusinessUnitSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslator
     */
    protected $restCompanyBusinessUnitSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchSortTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchAttributesTranslator = new RestCompanyBusinessUnitSearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $self = $this;

        $locale = 'de_DE';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyBusinessUnitSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyBusinessUnitSearchSortTransferMock);

        $this->restCompanyBusinessUnitSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $locale, $untranslated, $translated) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($untranslated['name_asc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_asc'];
                    case 2:
                        $self->assertSame($untranslated['name_desc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_desc'];
                }

                throw new Exception('Unexpected call count');
            });

        $this->restCompanyBusinessUnitSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanyBusinessUnitSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyBusinessUnitSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitSearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restCompanyBusinessUnitSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyBusinessUnitSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
