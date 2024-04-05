<style>
      @media only screen and (max-width:841px){
    .sd{
      margin:8px 0px;
    }
    .trd{
      margin:8px 0px;
    }
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5 mt-2">
            {{ __('Survey Management') }}
        </h2>
        <div class="flex flex-row justify-between items-center flex-wrap">
            <div>
                <ol class="flex items-center flex-wrap" aria-label="Breadcrumb">
                    <li class="inline-flex items-center sd">
                        <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500"
                            href="#">
                            {{ Auth::user()->role->role_name }} DashBoard
                        </a>
                        <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </li>
                    <li class="inline-flex items-center sd">
                        <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500"
                            href="{{ route('allSurvay') }}">
                            Survey Management
                            <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </li>
                    <li class="inline-flex items-center sd text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                        aria-current="page">
                        Assign Survey
                    </li>
                </ol>
            </div>
            <div class="trd">
                <a href="dashboard/allusers?role_id={{Auth::user()->role->id}}"
                    class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 3a1 1 0 011-1h8a1 1 0 011 1v2h3a1 1 0 011 1v12a1 1 0 01-1 1H6a1 1 0 01-1-1V6a1 1 0 011-1h3V3zm5 2H6v12h9V5h-3zM8 8a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Back
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success_message'))
                <div class="rounded-md bg-green-50 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/check-circle -->
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM5 9a1 1 0 011-1h1.6a1 1 0 01.7.3l3.3 3.4 2.7-2.7a1 1 0 111.4 1.4l-3 3a1 1 0 01-1.4 0l-4-4a1 1 0 010-1.4l1.5-1.5a1 1 0 011.4 0H14a1 1 0 010 2H7a1 1 0 01-1-1V9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success_message') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('error_message'))
                <div class="rounded-md bg-red-50 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/x-circle -->
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM5.293 6.707a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L11.414 12l3.293 3.293a1 1 0 01-1.414 1.414L10 13.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 12 5.293 8.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                {{ session('error_message') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="max-w-full w-full rounded overflow-hidden shadow-lg bg-white mb-4">
                <div class="px-6 py-4">
                    {{-- @php
                        print_r($user->userSurveys)
                    @endphp --}}
                    <h1 class="mb-2 mx-4">Surveys Alrady Assigned</h1>
                    <div class="grid grid-cols-12 gap-1 mb-2 mx-4">
                        <!-- First column with 1/12 width -->
                        <div class="col-span-2 bg-blue-200 p-2 text-center">
                            S. No.
                        </div>

                        <!-- Second column with 5/12 width -->
                        <div class="col-span-6 bg-blue-200 p-2">
                            Survey Name
                        </div>

                        <!-- Second column with 5/12 width -->
                        <div class="col-span-4 bg-blue-200 p-2">
                            Send Reminder
                        </div>
                    </div>
                    {{-- Surveys --}}
                    @foreach ($user->userSurveys as $s)
                        <div class="grid grid-cols-12 gap-1 mb-2 mx-4">
                            <!-- First column with 1/12 width -->
                            <div class="col-span-2 bg-gray-200 p-2 text-center">
                                {{ $s->id }}
                            </div>

                            <!-- Second column with 5/12 width -->
                            <div class="col-span-6 bg-gray-200 p-2">
                                {{ $s->survey->title }}
                            </div>

                            <!-- Second column with 5/12 width -->
                            <div class="col-span-4 bg-gray-200 p-2 flex justify-between items-center">
                                <button
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                                    Send Reminder
                                </button>
                                <button
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                                    Delete
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="max-w-full w-full rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-4">
                    <form action="{{ route('assignSurvey') }}" method="POST">
                        @csrf
                        <div class="mb-4 flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="input-field">
                                    Employe Name
                                </label>
                                <input id="input-field"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="w-2/3 ml-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="select-option">
                                    Select Survey To Assign
                                </label>
                                <select id="select-option" name="survey_id"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @foreach ($surveys as $survey)
                                        @if (!in_array($survey->id, $user->userSurveys->pluck('survey_id')->toarray()))
                                            <option value="{{ $survey->id }}">{{ Str::upper($survey->title) }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>
                        </div>
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Send Invite
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
