<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Nrc;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    public function afterCreate()
    {
        $dd = Nrc::find($this->data['nrcs_id'])->nrc_code;
        $type = $this->data['type'];
        $num = $this->data['nrc_num'];
        $ss = Nrc::find($this->data['nrcs_id'])->name_en;
        $zz = $dd . '/' . $ss . '(' . $type . ')' . $num;

        $this->record->update(['nrc_no' => $zz]);
    }
}
