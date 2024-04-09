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
   </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5 mt-2">
            {{ __('Survey Management') }}
        </h2>
        <div class="flex flex-row justify-between items-center flex-wrap">
            <div>
                <ol class="flex items-center flex-wrap" aria-label="Breadcrumb">
                    <li class="inline-flex items-center sd">
                        <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500"
                        href="{{ route('dashboard') }}">
                            Your Survey
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
                            href="{{ route('dashboard') }}">
                            {{ $survey->title }}
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
                        Start Survey
                    </li>
                </ol>
            </div>
            <div class="trd">
                <a href="{{ route('dashboard') }}"
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-100 text-sm">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 space-y-2 bg-gray-100 text-gray-800">
                        @if(!Auth::user()->userSurveys->where('survey_id',$survey->id)->first()->percentCompleted == 100)
                        <h3 class="text-base font-semibold">Part I: Instructions</h3>

                        <div class="flex gap-3">
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                        </div>
                        @else
                        <h3 class="text-base font-semibold">Survey completed successfully</h3>

                        <div class="flex gap-3">
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                        </div>
                        @endif
                    </div>
                    @if (session()->has('success_message'))
                        <div class="rounded-md bg-green-50 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/check-circle -->
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                    <h1 class="text-2xl font-bold mb-4 mt-8 text-center">{{ $survey->title }}</h1>


                    @if(!Auth::user()->userSurveys->where('survey_id',$survey->id)->first()->percentCompleted == 100)
                    <div class="flex items-center text-sm text-gray-500 mb-2 mx-4 justify-between">
                        <div>
                            <span class="mr-2">End Date: {{ $survey->end_date }}</span>
                            <span>Status: <span
                                    class="uppercase font-bold {{ $survey->status === 'active' ? 'text-green-500' : 'text-red-500' }}">{{ $survey->status }}</span></span>

                        </div>
                        <div>
                            <span class="mr-2">Category: {{ $survey->category->name }}</span>
                            <span>Created by: {{ $survey->creator->name }}</span>
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-bold mb-10 mx-4">Part I: Instructions</h2>
                    <div class="p-4 space-y-4 text-justify">{!! $survey->description !!}</div>
                    <h3 class="text-lg font-normal mb-4 mx-4">EVALUATION SCALE</h3>
                    <div class="overflow-x-auto mx-4">
                        <table class="table-auto border-collapse">
                            <tbody>
                                @foreach ($survey->evaluation as $scale)
                                    <tr class="border">
                                        <td class="border px-4 py-2 font-extrabold">{{ $scale->abbreviation }}</td>
                                        <td class="border px-4 py-2 font-bold">{{ $scale->fullForm }}</td>
                                        <td class="border px-4 py-2">{{ $scale->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="font-bold mb-4 m-4 ">
                        <strong>
                            If you are unable to evaluate or comment within a specific area, please skip and move to the
                            next area/review question.
                        </strong>
                    </div>
                    {{-- button --}}
                    <div class="flex justify-end my-6 mx-4 gap-x-1">
                        {{-- <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled">
                            Previous
                        </a> --}}
                        <form action="{{route('surveyOne')}}" method="POST">
                            @csrf
                            <input type="hidden" name="surveyId" value="{{$survey->id}}">
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Start Survey</button>
                        </form>
                        {{-- <a href="{{ route('viewSurvaySteptwo', ['Id' => $survey->id, 'part' => 'Part II']) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                           Start Survey
                        </a> --}}
                    </div>
                    @else
                    <div class="flex items-center text-sm text-gray-500 mb-2 mx-4 justify-between">
                        <div>
                            <span class="mr-2">End Date: {{ $survey->end_date }}</span>
                            <span>Status: <span
                                    class="uppercase font-bold text-green-700">Survey completed successfully.</span>

                        </div>
                        <div>
                            <span class="mr-2">Category: {{ $survey->category->name }}</span>
                            <span>Created by: {{ $survey->creator->name }}</span>
                        </div>
                    </div>
                    {{-- button --}}
                    <div class="flex justify-end my-6 mx-4 gap-x-1">
                        {{-- <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled">
                            Previous
                        </a> --}}
                        <form action="{{route('survey.view_completed')}}" method="POST">
                            @csrf
                            <input type="hidden" name="surveyId" value="{{$survey->id}}">
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">View Your Response</button>
                        </form>
                        {{-- <a href="{{ route('viewSurvaySteptwo', ['Id' => $survey->id, 'part' => 'Part II']) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                           Start Survey
                        </a> --}}
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
