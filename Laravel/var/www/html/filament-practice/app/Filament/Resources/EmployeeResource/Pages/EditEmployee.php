<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;


class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;
    use HasRecordNavigation;


    protected function getHeaderActions(): array
    {
        $existingActions = [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
        return array_merge($existingActions, $this->getNavigationActions());
    }
}
