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
    protected function tr1(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '128';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '3302104637';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 2059;
        $row->remittersLastName = 'LANDBANK OF THE PHILIPPINES';
        $row->remittersFirstName = 'NULL';
        $row->remittersMiddleName = 'NULL';
        $row->remittersAddress = 'LANDBANK Plaza 1598 MH del Pilar Dr J Quintos St Malate Manila';
        $row->receiversLastName = 'CITY GOVERNMENT OF CAUAYAN';
        $row->receiversFirstName = 'NULL';
        $row->receiversMiddleName = 'NULL';
        $row->receiversAddress = '107 CITY HALL RIZAL AVE DISTRICT 3';
        $row->receiversCity = 'CAUAYAN CITY';
        $row->receiversProvince = 'ISABELA';
        $row->organizationCode = 'LGU';
        $row->currencyCode = CurrencyCode::PHP;
        $row->emailAddress = 'galasanayjane2@gmail.com';
        $row->customerType = CustomerType::INDIVIDUAL;
        return $row;
    }
    protected function tr2(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '149';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '4222100440';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 5015;
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
    protected function tr3(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '156';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '0532100380';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 1;
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
    protected function tr4(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '171';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '1312101242';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 13242;
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
    protected function tr5(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '183';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '0872102124';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 1019.2;
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
    protected function tr6(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '229';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '1092101564';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 3415;
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
    protected function tr7(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '240';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '0302120293';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 3420;
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
    protected function tr8(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '308';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '1262146843';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 450;
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
    protected function tr9(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = '308';
        $row->transactionType = TransactionType::CREDIT_TO_CREDITORS;
        $row->timestamp = new DateTime('2025-06-17 00:00:00');
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = '3402105398';
        $row->receiversAccountNumber = '3462100018';
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = 14043.92;
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
    protected function generateRow1(): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = 'MTN';
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
        // $creditFile->addRow($this->tr1());
        // $creditFile->addRow($this->tr2());
        // $creditFile->addRow($this->tr3());
        // $creditFile->addRow($this->tr4());
        // $creditFile->addRow($this->tr5());
        // $creditFile->addRow($this->tr6());
        // $creditFile->addRow($this->tr7());
        // $creditFile->addRow($this->tr8());
        // $creditFile->addRow($this->tr9());
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

    /**
     * @test
     * @testdox Investigate
     *
     * @return void
     */
    public function investigate(): void
    {
        $date = (new DateTime())->modify('+1 day');
        $creditFile = new CreditFile('00xx', 'LBP1234567890', 1, './storage/');
        $file = __DIR__ . '/investigate_files/0021_20250619000330.txt';
        $rowCount = 0;
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
                $rowCount ++;
                if ($rowCount === 1 ) {
                    continue;
                }
                if (count($data) < 32) {
                    break;
                }
                $row = $this->generateCustomRow(
                    $data[0],
                    $data[1],
                    new DateTime(),
                    $data[7],
                    $data[8],
                    $data[11],
                );
                // echo $rowCount;echo "\n";
                $creditFile->addRow($row);
            }
            fclose($handle);
        }
        $creditFile->setSequenceNumber(2);
        $creditFile->setDate($date);

        $filePath = $creditFile->generate();
        $this->assertFileExists($filePath);
        $this->assertFileExists($creditFile->getRawFilePath());
        $this->assertFileExists($creditFile->getZipFilePath());
    }

    /**
     * Row
     *
     * @return Row
     */
    protected function generateCustomRow(
        string $agencyRefernceNumber,
        string $transactionType,
        DateTime $timestamp,
        string $sourceAccountNumber,
        string $receiverAccountNumber,
        string $amount,
    ): Row
    {
        $row = new Row();
        $row->agencyReferenceNumber = $agencyRefernceNumber;
        $row->transactionType = $transactionType;
        $row->timestamp = $timestamp;
        $row->settlementType = SettlementType::CREDIT_TO_LANDBANK_PHP;
        $row->targetCreditingApplication = TargetCreditingApplication::LANDBANK;
        $row->destinationBankCode = BankCode::LANDBANK_OF_THE_PHILIPPINES;
        $row->sourceAccountNumber = $sourceAccountNumber;
        $row->receiversAccountNumber = $receiverAccountNumber;
        $row->merchantBillerCode = '0021';
        $row->merchantReferenceNumber = null;
        $row->transactionAmount = $amount;
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
}
