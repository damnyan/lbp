<?php

namespace Tests;

use DateTime;
use Dmn\Lbp\CreditFile;
use Dmn\Lbp\CreditFile\Enum\BankCode;
use Dmn\Lbp\CreditFile\Enum\CurrencyCode;
use Dmn\Lbp\CreditFile\Enum\CustomerType;
use Dmn\Lbp\CreditFile\Enum\OrganizationCode;
use Dmn\Lbp\CreditFile\Enum\SettlementType;
use Dmn\Lbp\CreditFile\Enum\TargetCreditingApplication;
use Dmn\Lbp\CreditFile\Enum\TransactionType;
use Dmn\Lbp\CreditFile\Row;
use PHPUnit\Framework\TestCase;

class CreditFileTest extends TestCase
{
    /**
     * Row
     *
     * @return Row
     */
    protected function generateRow1(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = 'LBPT001722444438';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2023-05-18 07:30:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '8656003520';
        $row->receiversAccountNumber = '0276000055';
        $row->merchantBillerCode = null;
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 102.18;
        $row->remittersLastName = 'LANDBANK';
        $row->remittersFirstName = 'LBP';
        $row->remittersMiddleName = null;
        $row->remittersAddress = 'Makati City';
        $row->receiversLastName = 'JANE1';
        $row->receiversFirstName = 'JANE';
        $row->receiversMiddleName = 'LBCS';
        $row->receiversAddress = 'Pedro Gil';
        $row->receiversCity = 'Manila City';
        $row->receiversProvince = 'Metro Manila';
        $row->organizationCode = OrganizationCode::LANDBANK;
        $row->currencyCode = CurrencyCode::PHP;
        $row->emailAddress = 'galasanayjane2@gmail.com';
        $row->customerType = CustomerType::INDIVIDUAL;

        return $row;
    }

    /**
     * Row
     *
     * @return Row
     */
    protected function generateRow2(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = 'LBPT001722444439';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2023-05-18 07:30:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '8656003520';
        $row->receiversAccountNumber = '8655000861';
        $row->merchantBillerCode = null;
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 103.18;
        $row->remittersLastName = 'LANDBANK';
        $row->remittersFirstName = 'LBP';
        $row->remittersMiddleName = null;
        $row->remittersAddress = 'Malate Manila';
        $row->receiversLastName = 'JANE2';
        $row->receiversFirstName = 'JANE';
        $row->receiversMiddleName = 'LBCS';
        $row->receiversAddress = 'Maria Orosa';
        $row->receiversCity = 'Manila City';
        $row->receiversProvince = 'Metro Manila';
        $row->organizationCode = OrganizationCode::LANDBANK;
        $row->currencyCode = CurrencyCode::PHP;
        $row->emailAddress = 'galasanayjane2@gmail.com';
        $row->customerType = CustomerType::INDIVIDUAL;

        return $row;
    }

    /**
     * @test
     * @testdox It should generate cumulative hash
     *
     * @return void
     */
    public function rowClass(): void
    {
        $row = $this->generateRow1();
        $this->assertEquals(36529350, $row->getCumulativeHash());
        $this->assertIsArray($row->getCsvRow());

        $row = $this->generateRow1();
        $row->compute();
        $this->assertEquals(36529350, $row->getRecordHash());
        $this->assertEquals(36529350, $row->getCumulativeHash());

        $row->setPreviousCumulativeHash(1);
        $row->compute();
        $this->assertEquals(36529351, $row->getCumulativeHash());
    }

    /**
     * @test
     * @testdox It should generate file
     *
     * @return void
     */
    public function generate(): void
    {
        $date = (new DateTime())->modify('+1 day');
        $creditFile = new CreditFile('00xx', 'LBP1234567890', 1, './storage/');
        $creditFile->addRow($this->generateRow1());
        $creditFile->addRows($this->generateRow2());
        $creditFile->setSequenceNumber(2);
        $creditFile->setDate($date);

        $filePath = $creditFile->generate();
        $this->assertFileExists($filePath);
        $this->assertFileExists($creditFile->getRawFilePath());
        $this->assertFileExists($creditFile->getZipFilePath());
        $this->assertCount(2, $creditFile->getRows());
    }
}
