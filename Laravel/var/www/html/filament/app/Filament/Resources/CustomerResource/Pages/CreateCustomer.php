<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['created_by']=auth()->id();
        $data['updated_by']=auth()->id();

        return $data;
    }

}


