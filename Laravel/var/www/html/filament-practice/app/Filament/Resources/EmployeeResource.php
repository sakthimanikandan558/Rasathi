<?php

namespace App\Filament\Resources;


use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use App\Models\State;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\City;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Forms\Components\Section as formsection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Carbon;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\Actions\Action;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;






class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Employee Management';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                formsection::make('User Name')->description('put the details here')
                    ->schema([
                        Forms\Components\TextInput::make('firstname')->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('lastname')
                            ->maxLength(255),
                        // Translation::make('title')
                        //     ->label('Title')

                    ])->columns(2),
                formsection::make('User Address')->description('put the Address in brief here')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255)
                            ->prefixAction(
                                Action::make('showPrefix')
                                    ->icon('heroicon-m-home')
                                    ->color('primary')
                                    ->action(function (Set  $set, $state) {
                                        $set('address', $state);
                                    })
                            )
                            ->suffixAction(
                                Action::make('showsuffix')
                                    ->icon('heroicon-m-eye')
                                    ->color('primary')
                                    ->action(function (Set  $set, $state) {
                                        $set('address', $state);
                                    })
                            ),
                        Forms\Components\Select::make('country_id')
                            ->relationship(name: 'country', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('state_id')
                            ->relationship(name: 'state', titleAttribute: 'name')
                            ->options(fn(Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('city_id', null))
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->relationship(name: 'city', titleAttribute: 'name')
                            ->options(fn(Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(2),

                Forms\Components\TextInput::make('zip_code')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\DatePicker::make('date_hired'),
                Forms\Components\Select::make('department_id')
                    ->relationship(name: 'department', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->hidden(auth()->user()->is_admin == false),

                Tables\Columns\TextColumn::make('country.name')
                    ->numeric()
                    ->sortable()
                    ->hidden(auth()->user()->is_admin == false),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable()
                    ->hidden(auth()->user()->is_admin == false),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable()
                    ->hidden(auth()->user()->is_admin == false),

                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable()
                    ->hidden(auth()->user()->is_admin == false),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters(
                [
                    SelectFilter::make('Department')
                        ->relationship('department', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Filter by Department')
                        ->indicator('Department'),
                    Filter::make('created_at')
                        ->form([
                            DatePicker::make('created_from'),
                            DatePicker::make('created_until'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['created_from'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                                );
                        })
                        ->indicateUsing(function (array $data): array {
                            $indicators = [];
                            if ($data['created_from'] ?? null) {
                                $indicators['created_from'] = 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                            }
                            if ($data['created_until'] ?? null) {
                                $indicators['created_until'] = 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                            }

                            return $indicators;
                        })
                    // ->columnSpan(2)->columns(2)
                    ,
                ],
                // layout: FiltersLayout::AboveContent
            )
            // ->filtersFormColumns(3)

            ->actions([
                Tables\Actions\Action::make('preview')

                    ->icon('heroicon-o-eye')
                    ->color('danger')
                    ->infolist([
                        Section::make('Basic Information')
                            ->description('Basic user details')
                            ->schema([
                                TextEntry::make('firstname'),
                                TextEntry::make('lastname'),
                                TextEntry::make('address')
                                    ->hidden(auth()->user()->is_admin == false),
                                TextEntry::make('dob')
                                    ->date(),
                                TextEntry::make('date_hired')
                                    ->date(),
                            ])->columns(2),

                        Section::make('Location Information')
                            ->description('User location details')
                            ->schema([
                                TextEntry::make('country.name')
                                    ->numeric()
                                    ->hidden(auth()->user()->is_admin == false),
                                TextEntry::make('state.name')
                                    ->numeric()
                                    ->hidden(auth()->user()->is_admin == false),
                                TextEntry::make('city.name')
                                    ->numeric()
                                    ->hidden(auth()->user()->is_admin == false),
                                TextEntry::make('zip_code')
                                    ->hidden(auth()->user()->is_admin == false),
                            ])->columns(2),



                    ])->modalSubmitAction(''),


                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Basic Information')
                    ->description('Basic user details')
                    ->schema([
                        TextEntry::make('firstname'),
                        TextEntry::make('lastname'),
                        TextEntry::make('address')
                            ->hidden(auth()->user()->is_admin == false),
                        TextEntry::make('dob')
                            ->date(),
                        TextEntry::make('date_hired')
                            ->date(),
                    ])->columns(2),

                Section::make('Location Information')
                    ->description('User location details')
                    ->schema([
                        TextEntry::make('country.name')
                            ->numeric()
                            ->hidden(auth()->user()->is_admin == false),
                        TextEntry::make('state.name')
                            ->numeric()
                            ->hidden(auth()->user()->is_admin == false),
                        TextEntry::make('city.name')
                            ->numeric()
                            ->hidden(auth()->user()->is_admin == false),
                        TextEntry::make('zip_code')
                            ->hidden(auth()->user()->is_admin == false),
                    ])->columns(2),

                Section::make('Additional Information')
                    ->description('Additional details')
                    ->schema([

                        IconEntry::make('firstname')
                            ->boolean(),
                        IconEntry::make('lastname')
                            ->boolean(),



                        ColorEntry::make('color_field')
                            ->label('Favorite Color')
                            ->default('green'), // Set the default color

                        KeyValueEntry::make('key_value_field')
                            ->label('Key-Value')
                            ->default([
                                'Key1' => 'Value1',
                                'Key2' => 'Value2',
                            ]),


                    ])->columns(2),



            ]);
    }
}
