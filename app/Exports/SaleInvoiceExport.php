<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class SaleInvoiceExport implements FromArray, WithTitle, WithStyles, WithDrawings, WithEvents, ShouldAutoSize
{
    protected $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale->load('customer', 'products');
    }

    public function array(): array
    {
        $sale = $this->sale;
        $customer = $sale->customer;

        $rows = [];

        // Row 1: Company Name
        $rows[] = ['Laptop Hospital Pvt. Ltd.'];

        // Row 2: Address
        $rows[] = ['New Plaza, Kathmandu'];

       $rows[] = ['DATE: ' . $sale->sale_date->format('Y-m-d')];
$rows[] = ['INVOICE NO.: ' . $sale->id];


       $rows[] = ['BILL TO: ' . ($customer->name ?? '')];
$rows[] = ['EMAIL: ' . ($customer->email ?? '')];
        // Row 6: Table Headings
        $rows[] = ['DESCRIPTION', 'QTY', 'UNIT PRICE', 'DISCOUNT', 'TOTAL'];

        // Row 7–??: Products
        foreach ($sale->products as $product) {
            $discount = $product->pivot->discount;
            $unit_price = $product->pivot->price_at_sale;
            $qty = $product->pivot->quantity;
            $total = ($unit_price * $qty) - $discount;

            $rows[] = [
                $product->name,
                $qty,
                $unit_price,
                $discount,
                $total,
            ];
        }

        // Up to row 14
        $rows[] = ['Subtotal', '', '', '', $sale->total_amount];
        $rows[] = ['DISCOUNT', '', '', '', 'xx'];
        $rows[] = ['SUBTOTAL LESS DISCOUNT', '', '', '', 'xx'];
        $rows[] = ['VAT RATE', '', '', '', 'xx'];
        $rows[] = ['TOTAL VAT', '', '', '', 'xx'];
        $rows[] = ['SHIPPING / HANDLING', '', '', '', 'xx'];
        $rows[] = ['Total', '', '', '', 'xx'];

        return $rows;
    }

    public function title(): string
    {
        return 'Invoice_' . $this->sale->id;
    }

    public function styles(Worksheet $sheet)
    {
        // Company Name (Row 1)
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Address (Row 2)
        $sheet->mergeCells('A2:E2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Align invoice info (Date, Invoice, Email)
        $sheet->getStyle('A3:E5')->applyFromArray([
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Table Headings (Row 6)
        $sheet->getStyle('A7:E7')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],

        ]);
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function ($event) {
                $sheet = $event->sheet;

                // Product rows start from row 8
                $productRowStart = 8;
                $productCount = $this->sale->products->count();
                $lastBorderRow = 7 + $productCount + 1; // table heading + product rows + subtotal row


                $sheet->getStyle("A7:E{$lastBorderRow}")
                    ->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle('A15:E15')->applyFromArray([
                'font' => ['bold' => true],
            ]);   
            },
        ];
    }

   public function drawings()
{
    $drawing = new Drawing();
    $drawing->setName('Company Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath(public_path('logo/logo.jfif')); // Ensure path uses forward slashes
    $drawing->setHeight(70);
    $drawing->setCoordinates('E1'); // 🆕 Move logo to top right
    $drawing->setOffsetX(0);
    $drawing->setOffsetY(5);

    return [$drawing];
}
}
