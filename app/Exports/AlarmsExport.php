<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class AlarmsExport implements FromView
{
    protected $alarms;

    public function __construct($alarms)
    {
        $this->alarms = $alarms;
    }
    public function view(): View
    {
        return view('exports.alarms_excel', [
            'alarms' => $this->alarms
        ]);
    }

    public function store($filename): string
    {
        return FacadesExcel::store(new AlarmsExport($this->alarms), $filename, 'public');
    }
}
