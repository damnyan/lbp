<?php

namespace Dmn\Lbp;

use DateTime;
use Dmn\Lbp\CreditFile\Row;
use ZipArchive;

class CreditFile
{
    protected array $rows = [];

    protected int $previousCumulativeHash = 0;

    protected int $recordHash = 0;

    protected int $rowCount = 0;

    protected float $totalTransactionAmount = 0;

    protected string|null $rawFilePath = null;
    protected string|null $zipFilePath = null;

    /**
     * Construct
     *
     * @param string $agencyCode
     * @param string $filePassword
     * @param integer $sequenceNumber
     * @param string $path
     * @param DateTime|null|null $date
     */
    public function __construct(
        protected string $agencyCode,
        protected string $filePassword,
        protected int $sequenceNumber = 1,
        protected string $path = '/',
        protected DateTime|null $date = null,
    ) {
        if (is_null($date)) {
            $this->date = new DateTime();
        }
    }

    /**
     * Set sequence number
     *
     * @param integer $sequenceNumber
     * @return void
     */
    public function setSequenceNumber(int $sequenceNumber): void
    {
        $this->sequenceNumber = $sequenceNumber;
    }

    /**
     * Set Date
     *
     * @param integer $sequenceNumber
     * @return void
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get raw file path
     *
     * @return string|null
     */
    public function getRawFilePath(): string|null
    {
        return $this->rawFilePath;
    }

    /**
     * Get zip file path
     *
     * @return string|null
     */
    public function getZipFilePath(): string|null
    {
        return $this->zipFilePath;
    }

    /**
     * Add row
     *
     * @param Row $row
     * @return void
     */
    public function addRow(Row $row): void
    {
        $row->setPreviousCumulativeHash($this->previousCumulativeHash);
        $row->compute();
        $this->previousCumulativeHash = $row->getCumulativeHash();
        $this->recordHash = $this->recordHash + $row->getRecordHash();
        $this->rowCount++;
        $this->totalTransactionAmount = $this->totalTransactionAmount + $row->getTransactionAmount();

        array_push($this->rows, $row);
    }

    /**
     * Add rows
     *
     * @param Row ...$rows
     * @return void
     */
    public function addRows(Row ...$rows): void
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    /**
     * Get rows
     *
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Footer value
     *
     * @return string
     */
    protected function footerValue(): string
    {
        return implode('|', [
            $this->rowCount,
            $this->totalTransactionAmount,
            $this->recordHash
        ]);
    }

    protected function headers(): array
    {
        return [
            [], [], [
                'Credit File Rows',
                null,
                'Record Hash',
                'Cumulative Hash',
                null,
                'Agency Reference Number',
                'Transaction Type',
                'Transaction Date',
                'Transaction Time',
                'Settlement Type',
                'Target Crediting App',
                'Dest Bank Code',
                'Source Account Number',
                'Receiver\'s Account Number',
                'Merchant Biller Code',
                'Merchant Reference Number',
                'Transaction Amount',
                'Remitter\'s Name',
                'Remitter\'s First Name',
                'Remitter\'s Middle Name',
                'Remitter\'s Address',
                'Receiver\'s Name',
                'Receiver\'s First Name',
                'Receiver\'s Middle Name',
                'Receiver\'s Address - Bldg/House No, Street, Barangay',
                'Receiver\'s Address - Town, District, City',
                'Receiver\'s Address - State/Province',
                'Organization Code',
                'Currency',
                'Email Address',
                'Customer Type',
                'Remarks',
            ],
        ];
    }

    /**
     * File name
     *
     * @return string
     */
    protected function filename(): string
    {
        $filename = $this->agencyCode
            . '_'
            . $this->date->format('Ymd')
            . str_pad($this->sequenceNumber, 6, '0', STR_PAD_LEFT);

        return $filename;
    }

    /**
     * Generate
     *
     * @return string
     */
    public function generate(): string
    {
        $filename = $this->filename();
        $this->rawFilePath = $this->path . $filename . '.txt';
        $this->zipFilePath = $this->path . $filename . '.zip';

        $f = fopen($this->rawFilePath, 'w');

        $this->addHeaders($f);
        foreach ($this->rows as $row) {
            /** @var \Dmn\Lbp\CreditFile\Row $row */
            fputcsv($f, $row->getCsvRow());
        }

        fputcsv($f, [null, null, $this->recordHash]);

        $this->addFooter($f);

        fclose($f);

        $this->createZip();
        return $this->zipFilePath;
    }

    /**
     * Create zip
     *
     * @return string
     */
    public function createZip(): string
    {
        $basename = basename($this->rawFilePath);

        $zip = new ZipArchive();
        $zip->open($this->zipFilePath, ZipArchive::CREATE);
        $zip->addFile($this->rawFilePath, $basename);
        $zip->setEncryptionName($basename, ZipArchive::EM_AES_256, $this->filePassword);
        $zip->close();
        return '';
    }

    /**
     * Add headers
     *
     * @param resource $f
     * @return void
     */
    protected function addHeaders(&$f): void
    {
        foreach ($this->headers() as $header) {
            fputcsv($f, $header);
        }
    }

    /**
     * Add footer
     *
     * @param [type] $f
     * @return void
     */
    protected function addFooter(&$f): void
    {
        fputcsv($f, [null]);
        fputcsv($f, ['Footer Record']);
        fputcsv($f, [$this->footerValue()]);
    }
}
