<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use App\Models\Product;


class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Customize data before saving
        $data['name'] = strtoupper($data['name']);
        return $data;
    }
    
    protected function handleRecordCreation(array $data): Product
    {
        Log::info('Creating a new product with data:', $data);

        return Product::create($data);
    }
}
