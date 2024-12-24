<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;

class CustomerRelationManager extends RelationManager
{
    protected static string $relationship = 'customer_contact';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('contact_type')->required()
                    ->options([
                        'primary' => 'primary',
                        'others' => 'others',

                    ])
                    ->native(false),

                TextInput::make('name')->required()->regex('/^[\pL\s]+$/u'),
                TextInput::make('phone')->required()->numeric()->minLength(10)->maxLength(10),
                TextInput::make('email')->required()->email()->unique('customer_contact', 'email'),

                Toggle::make('is_active')->required(),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('contact_type'),
                TextColumn::make('name'),
                TextColumn::make('phone'),
                TextColumn::make('email'),

                TextColumn::make('is_active'),



            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function validationMessages()
    {
        return [
            'name.regex' => 'The name may only contain letters and spaces.',
            'email.unique' => 'The email is .',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
        ];
    }
}
