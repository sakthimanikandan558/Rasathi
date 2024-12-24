<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use JoseEspinal\RecordNavigation\Traits\HasRecordsList;



class ListEmployees extends ListRecords
{
    use HasRecordsList;

    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {

        $departments = Department::pluck('name')->toArray();


        $tabs = [];

        // Add a default "All" tab
        $tabs['All'] = Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query)
            // ->badge(Employee::count())
        ;

        foreach ($departments as $department) {
            $tabs[$department] = Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('department', function (Builder $query) use ($department) {
                    $query->where('name', $department);
                }))
                // ->badge(Employee::whereHas('department', function (Builder $query) use ($department) {
                //     $query->where('name', $department);
                // })->count())
            ;
        }

        return $tabs;
    }
}
