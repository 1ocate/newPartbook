<?php

namespace App\Exports;

use App\Models\AskPrice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Sheet;

class AskPriceExport implements FromQuery, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{

    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // User company, address merge cell
                $event->sheet->getDelegate()->mergeCells('A1:E1');
                $event->sheet->getDelegate()->mergeCells('A2:E2');
            },
        ];
    }

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return AskPrice::query()->where('id', $this->id);
    }
    

    public function headings(): array
    {
        return [
           [AskPrice::find($this->id)->user->company ],
           [AskPrice::find($this->id)->user->company_address ],
           ['No', 'Part Name','Machine','Qty','Price'],
        ];
    }
    public function map($askPrice): array
    {
        $lineNumber=1;
        foreach ($askPrice->askPriceLines as $askPriceLine) {

            $excelLine[]=[
                $lineNumber,
                $askPriceLine->partname,
                $askPriceLine->machine,
                $askPriceLine->qty,
            ];
            $lineNumber++;
        }
        // This excel publish by partook.co.id
        array_push($excelLine,[''],['','By Partbook.id(https://partbook.id)']);
        return $excelLine;
    
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/favicon/apple-icon.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');

        return $drawing;
    }

    
    
   
    
    
}