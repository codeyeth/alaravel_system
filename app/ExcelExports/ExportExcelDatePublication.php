<?php

namespace App\ExcelExports;

use App\Models\OgSoftcopy;
use App\Models\PublicationType;
use App\Models\PublicationTypeChildren;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use DB;

class ExportExcelDatePublication implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $dateFrom;
    public $dateTo;
    
    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }
    
    public function query()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $publicationDate = OgSoftcopy::query()->whereRaw('date >= ? AND date <= ?', array($dateFrom, $dateTo))->orderBy('id', 'ASC');
        
        return $publicationDate;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'ARTICLE TITLE', 'PUBLICATION TYPE', 'DATE PUBLISHED', 'PETITIONER', 'ADDRESS', 'ENCODED BY', 'ENCODED AT',],
        ];
    }
    
    public function map($monthly_report): array
    {
        $datePublished = Carbon::create($monthly_report->date_published)->toFormattedDateString();
        $publicationType = '';        
        if( $monthly_report->publication_type != '' ){
            $publicationType = PublicationType::find($monthly_report->publication_type);
            $publicationType = $publicationType->publication_type;        
        }
        
        $subPublicationType = '';
        if( $monthly_report->publication_sub_type != '' ){
            $subPublicationType = PublicationTypeChildren::find($monthly_report->publication_sub_type);
            $subPublicationType = ' - ' . $subPublicationType->publication_type_child;
        }
        
        return [
            $monthly_report->id,
            $monthly_report->article_title,
            $publicationType . $subPublicationType,
            $datePublished,
            $monthly_report->petitioner_name,
            $monthly_report->petitioner_address,
            $monthly_report->encoded_by_name,
            $monthly_report->created_at->toDayDateTimeString(),
        ];
    }
    
}