<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\CustomerResource\RelationManagers\CustomerRelationManager;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('Username'))->helperText('your name should be like ex:RASATHI S')->autocapitalize('words')->required(),
                TextInput::make('code')->required()->numeric()->minlength(4)->maxLength(4),
                TextInput::make('legal_name')->regex('/^[\pL\s]+$/u')->required(),
                Select::make('status')->required()
                    ->options([
                        'ACTIVE' => 'ACTIVE',
                        'INACTIVE' => 'INACTIVE',
                        'POTENTIAL' => 'POTENTIAL',
                    ])
                    ->native(false),
                Select::make('source')->required()
                    ->options([
                        'Direct' => 'Direct',
                        'Indirect' => 'Indirect',

                    ])
                    ->native(false),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('code'),
                TextColumn::make('legal_name'),
                TextColumn::make('status'),
                TextColumn::make('source'),


            ])
            // ->filters([
            //     Filter::make('status')
            //     ->query(fn (Builder $query): Builder => $query->where('status', 'ACTIVE'))
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CustomerRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'ACTIVE');
    }

    public static function validationMessages()
    {
        return [
            'legal_name.regex' => 'The legal name may only contain letters and spaces.',
            'code.digits' => 'code should have only digits'
        ];
    }
}
