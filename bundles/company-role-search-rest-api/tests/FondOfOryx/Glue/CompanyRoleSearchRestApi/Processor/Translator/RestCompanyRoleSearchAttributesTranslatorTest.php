<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer;

class RestCompanyRoleSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator\RestCompanyRoleSearchAttributesTranslator
     */
    protected $restCompanyRoleSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyRoleSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyRoleSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchSortTransferMock = $this->getMockBuilder(RestCompanyRoleSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchAttributesTranslator = new RestCompanyRoleSearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'en_US';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyRoleSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyRoleSearchSortTransferMock);

        $this->restCompanyRoleSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restCompanyRoleSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanyRoleSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyRoleSearchAttributesTransferMock,
            $this->restCompanyRoleSearchAttributesTranslator->translate(
                $this->restCompanyRoleSearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'en_US';

        $this->restCompanyRoleSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyRoleSearchAttributesTransferMock,
            $this->restCompanyRoleSearchAttributesTranslator->translate(
                $this->restCompanyRoleSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
