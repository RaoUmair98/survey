<?php

namespace App\Livewire;

use App\Models\Survey;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Responsive;
use Illuminate\Support\Str;


final class SurvaysTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            // Responsive::make(), 
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Survey::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title',  fn (Survey $model) => Str::words(e($model->title), 4))
            ->add('category', fn (Survey $model) => Str::upper(e($model->category->name)))
            ->add('end_date_formatted', fn (Survey $model) => Carbon::parse($model->end_date)->format('d/m/Y'))
            ->add('status', function (Survey $model) {
                return $model->status == "active"  ? "<span class='text-green-400   text-extrabold'>" . Str::upper($model->status) . "</span>" : "<span class='text-red-400   text-extrabold'>" .  Str::upper($model->status) . "</span>";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Category', 'category')
                ->sortable()
                ->searchable(),
            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         Filter::datepicker('end_date'),
    //     ];
    // }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        if (Auth::user()->role->id == 1) {
        return redirect()->route('editSurvey', ['Id' => $rowId]);
        }
    }

    #[\Livewire\Attributes\On('view')]
    public function view($rowId)
    {
        return redirect()->route('viewSurvey', ['Id' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        if (Auth::user()->role->id == 1) {
            // Fetch the survey record
            $survey = Survey::findOrFail($rowId);

            // Delete associated records, if any
            // Assuming there is a relationship between Survey and related records
            $survey->questions()->delete();

            // Delete the survey record
            $survey->delete();

            // Refresh the Livewire component
            $this->refresh();
        }
    }

    #[\Livewire\Attributes\On('note')]
    public function note($rowId)
    {
        if (Auth::user()->role->id == 1) {
            // Fetch the survey record
            $survey = Survey::findOrFail($rowId);

            $this->js('alert("The Note facilities form, Survey: ' .  strtoupper($survey->title) . '"is disabled for testing)');

            // Delete associated records, if any
            // Assuming there is a relationship between Survey and related records
            // $survey->questions()->delete();

            // // Delete the survey record
            // $survey->delete();

            // // Refresh the Livewire component
            // $this->refresh();

        }
    }

    public function actions(Survey $row): array
    {
        return [
            Button::add('view')
                ->slot('<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8806 7.454C15.2952 6.174 12.9999 2 7.99991 2C2.99991 2 0.704581 6.174 0.119247 7.454C0.040673 7.62553 0 7.81199 0 8.00067C0 8.18934 0.040673 8.3758 0.119247 8.54733C0.704581 9.826 2.99991 14 7.99991 14C12.9999 14 15.2952 9.826 15.8806 8.546C15.959 8.37466 15.9996 8.18843 15.9996 8C15.9996 7.81157 15.959 7.62534 15.8806 7.454ZM7.99991 12C7.20879 12 6.43543 11.7654 5.77763 11.3259C5.11984 10.8864 4.60715 10.2616 4.3044 9.53073C4.00165 8.79983 3.92243 7.99556 4.07677 7.21964C4.23111 6.44372 4.61208 5.73098 5.17149 5.17157C5.7309 4.61216 6.44363 4.2312 7.21955 4.07686C7.99548 3.92252 8.79974 4.00173 9.53065 4.30448C10.2616 4.60723 10.8863 5.11992 11.3258 5.77772C11.7653 6.43552 11.9999 7.20887 11.9999 8C11.9989 9.06054 11.5771 10.0773 10.8272 10.8273C10.0773 11.5772 9.06045 11.9989 7.99991 12Z" fill="white"/>
                <path d="M7.99992 10.6667C9.47268 10.6667 10.6666 9.47276 10.6666 8C10.6666 6.52724 9.47268 5.33334 7.99992 5.33334C6.52716 5.33334 5.33325 6.52724 5.33325 8C5.33325 9.47276 6.52716 10.6667 7.99992 10.6667Z" fill="white"/>
                </svg>
                ')
                ->id()
                ->class('bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('view', ['rowId' => $row->id]),

            Button::add('edit')
                ->slot('
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_84_890)">
                    <path d="M14 8C13.9998 7.63218 13.9663 7.26512 13.9 6.90333L15.9286 5.73333L13.9286 2.26667L11.8993 3.43933C11.339 2.95995 10.6951 2.58796 9.99996 2.342V0H5.99996V2.342C5.30479 2.58796 4.66092 2.95995 4.10062 3.43933L2.07129 2.26667L0.0712891 5.73333L2.09996 6.90333C1.9667 7.62837 1.9667 8.37163 2.09996 9.09667L0.0712891 10.2667L2.07129 13.7333L4.10062 12.5613C4.66098 13.0405 5.30484 13.4122 5.99996 13.658V16H9.99996V13.658C10.6951 13.412 11.339 13.04 11.8993 12.5607L13.9286 13.7333L15.9286 10.2667L13.9 9.09667C13.9663 8.73488 13.9998 8.36782 14 8ZM9.99996 8C9.99996 8.39556 9.88266 8.78224 9.6629 9.11114C9.44313 9.44004 9.13077 9.69638 8.76532 9.84776C8.39987 9.99914 7.99774 10.0387 7.60978 9.96157C7.22181 9.8844 6.86545 9.69392 6.58574 9.41421C6.30604 9.13451 6.11556 8.77814 6.03838 8.39018C5.96121 8.00222 6.00082 7.60009 6.1522 7.23463C6.30357 6.86918 6.55992 6.55682 6.88881 6.33706C7.21771 6.1173 7.60439 6 7.99996 6C8.53039 6 9.0391 6.21071 9.41417 6.58579C9.78924 6.96086 9.99996 7.46957 9.99996 8Z" fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_84_890">
                    <rect width="16" height="16" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>

                ')
                ->id()
                ->class('bg-amber-500 hover:bg-amber-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_21_2166)">
                <path d="M11.3333 2.66667V1.33333C11.3333 0.979711 11.1928 0.640573 10.9427 0.390524C10.6927 0.140476 10.3535 0 9.99992 0L5.99992 0C5.6463 0 5.30716 0.140476 5.05711 0.390524C4.80706 0.640573 4.66659 0.979711 4.66658 1.33333V2.66667H1.33325V4H2.66659V14C2.66659 14.5304 2.8773 15.0391 3.25237 15.4142C3.62744 15.7893 4.13615 16 4.66658 16H11.3333C11.8637 16 12.3724 15.7893 12.7475 15.4142C13.1225 15.0391 13.3333 14.5304 13.3333 14V4H14.6666V2.66667H11.3333ZM7.33325 11.3333H5.99992V7.33333H7.33325V11.3333ZM9.99992 11.3333H8.66658V7.33333H9.99992V11.3333ZM9.99992 2.66667H5.99992V1.33333H9.99992V2.66667Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_21_2166">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>
                ')
                ->id()
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('delete', ['rowId' => $row->id]),

            Button::add('note')
                ->slot('
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.6667 12H15.6933C15.46 12.6067 15.1067 13.1667 14.6333 13.64L13.6467 14.6267C13.1733 15.1 12.6133 15.4533 12.0067 15.6867V12.66C12.0067 12.2933 12.3067 11.9933 12.6733 11.9933L12.6667 12ZM16 3.33333V10.34C16 10.4467 15.9933 10.5533 15.9867 10.6667H12.6667C11.5667 10.6667 10.6667 11.5667 10.6667 12.6667V15.9867C10.56 15.9933 10.4533 16 10.34 16H3.33333C1.49333 16 0 14.5067 0 12.6667V3.33333C0 1.49333 1.49333 0 3.33333 0H12.6667C14.5067 0 16 1.49333 16 3.33333Z" fill="white"/>
                </svg>')
                ->id()
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('note', ['rowId' => $row->id])

        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
