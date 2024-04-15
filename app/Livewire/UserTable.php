<?php

namespace App\Livewire;

use App\Models\ManagerResponse;
use App\Models\ManagerSurvay;
use App\Models\SurveyResponse;
use App\Models\User;
use App\Models\UserSurvay;
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

final class UserTable extends PowerGridComponent
{
    use WithExport;
    public $role_id;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {

        if ($this->role_id ===  3) {
            return User::whereNot('role_id', 1)->where('role_id', $this->role_id)->with('role');
        } else {

            if (in_array(Auth::user()->role->id,  [1, 2])) {
                return User::whereNot('role_id', 1)->with('role');
            }

            return User::whereNot('role_id', 1)->where('manager_id', Auth::user()->id)->with('role');
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('manager', function (User $user) {
                return strtoupper(User::find($user->manager_id)->name);
            })
            ->add('role', function (User $user) {
                return strtoupper($user->role->role_name);
            });
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),



            Column::make('Reports To', 'manager'),
            Column::make('Role', 'role'),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        // $this->js('alert(' . $rowId . ')');
        return redirect()->route('editUser', ['userId' => $rowId]);
    }
    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        $user = User::findOrFail($rowId);

        // Check if the user has employees under
        $subordinates = $user->subordinates();
        if ($subordinates->count() == 0) {
            // Retrieve user's surveys
            $user_surveys = UserSurvay::where('user_id', $user->id)->get();
            $manager_surveys = ManagerSurvay::where('user_id', $user->id)->get();

            $survey_responses = SurveyResponse::where('user_id', $user->id)->get();
            $manager_responses = ManagerResponse::where('user_id', $user->id)->get();
            
            foreach ($survey_responses as $survey_response) {
                $survey_response->delete();
            }

            foreach ($manager_responses as $manager_response) {
                $manager_response->delete();
            }

            // Delete user's surveys
            foreach ($user_surveys as $user_survey) {
                $user_survey->delete();
            }

            // Delete manager's surveys
            foreach ($manager_surveys as $manager_survey) {
                $manager_survey->delete();
            }

            // Delete the user
            $user->delete();

            $this->js('alert("User ' . strtoupper($user->name) . ' has been deleted.")');
            $this->dispatch('$refresh');
        } else {
            $this->js('alert("Error: Cannot delete user ' . strtoupper($user->name) . ' because they have employees assigned.")');
        }

    }

    #[\Livewire\Attributes\On('email')]
    public function email($rowId)
    {
        return redirect()->route('sendSurveyInvite', ['userId' => $rowId]);
    }

    public function actions(User $row): array
    {
        return [
            Button::add('email')
                ->slot('<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_82_94)">
                <path d="M3.68066 13.2667H7.22866L9.57466 15.61C9.70075 15.7368 9.85064 15.8374 10.0157 15.906C10.1808 15.9747 10.3579 16.01 10.5367 16.01C10.6543 16.0098 10.7714 15.9948 10.8853 15.9653C11.1155 15.9072 11.3263 15.7895 11.4964 15.624C11.6666 15.4585 11.7902 15.2511 11.8547 15.0227L15.9927 0.949997L3.68066 13.2667Z" fill="white"/>
                <path d="M2.72485 12.3333L15.0482 0.00800323L0.985519 4.15534C0.756543 4.22045 0.548571 4.34431 0.382236 4.51461C0.215902 4.68491 0.0969854 4.89575 0.0372847 5.12619C-0.0224161 5.35664 -0.0208262 5.59869 0.0418965 5.82834C0.104619 6.05798 0.226295 6.26723 0.394852 6.43534L2.72485 8.76334V12.3333Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_82_94">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>')
                ->id()
                ->class('bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded')
                ->dispatch('email', ['rowId' => $row->id]),

            Button::add('edit')
                ->slot('
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_22_4000)">
                <path d="M9.736 3.79134L0 13.5267V16H2.47333L12.2087 6.264L9.736 3.79134Z" fill="white"/>
                <path d="M15.4878 0.512001C15.1598 0.18412 14.715 -6.86646e-05 14.2512 -6.86646e-05C13.7873 -6.86646e-05 13.3425 0.18412 13.0145 0.512001L10.6812 2.84867L13.1538 5.32133L15.4872 2.988C15.6499 2.82557 15.7791 2.63263 15.8673 2.42022C15.9554 2.20781 16.0008 1.98011 16.0009 1.75014C16.001 1.52017 15.9557 1.29244 15.8676 1.07999C15.7796 0.867533 15.6505 0.674523 15.4878 0.512001Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_22_4000">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>
                ')
                ->id()
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded')
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
                ->dispatch('delete', ['rowId' => $row->id])

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
