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
                            href="/dashboard">
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
                        Survey {{ $part }}
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
                        <h3 class="text-base font-semibold">{{ $part }}: {{ $questions->first()->partTitle }}
                        </h3>
                        <div class="flex gap-3">
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-600"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                            <span class="w-12 h-2 rounded-sm bg-blue-300"></span>
                        </div>
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
                    <h1 class="text-2xl font-bold mb-4 mt-6 text-center">{{ $survey->title }}</h1>
                    <div class="flex items-center text-sm text-gray-500 mb-2 mx-4 justify-between">
                        <div>
                            <span class="mr-2">End Date: {{ $survey->end_date }}</span>
                            <span>Status: <span
                                    class="uppercase font-bold {{ $survey->status === 'active' ? 'text-green-500' : 'text-red-500' }}">{{ $survey->status }}</span></span>

                        </div>
                        <div>
                            <span class="mr-2">Category: {{ Str::upper($survey->category->name) }}</span>
                            <span>Created by: {{ $survey->creator->name }}</span>
                        </div>

                    </div>

                    <h2 class="text-xl font-bold mb-4 mx-4">{{ $part }}: {{ $questions->first()->partTitle }}
                    </h2>
                    @php
                        $subheads = $questions->pluck('subTitle')->unique()->toArray();
                    @endphp
                     <form action="{{ route('surveyThree') }}" method="POST" id="partIIForm">
                        @csrf
                        @foreach ($subheads as $subhead)
                            <h3 class="font-bold mb-4 mt-4 mx-4">{{ str::upper($subhead) }}</h3>
                            @foreach ($questions as $question)
                                @if ($question->subTitle == $subhead)
                                    <div class="grid grid-cols-12 gap-1 mb-2 mx-4">
                                        <!-- First column with 1/12 width -->
                                        <div class="col-span-1 bg-gray-200 p-2 text-center">{{ $question->id }}</div>

                                        <!-- Second column with 5/12 width -->
                                        <div class="col-span-7 bg-gray-200 p-2">
                                            {{ $question->questionText }}
                                            @if ($question->questionLegend != null)
                                                <br>
                                                <span class="text-xs text-blue-400">
                                                    {{ $question->questionLegend }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Third column with 3/12 width -->
                                        <div class="col-span-4 bg-gray-200 p-2">
                                            <div class="col-span-4 bg-gray-200 p-2">
                                                <input type="text" name="answer[{{$question->id}}]"
                                                    class="w-full py-2 px-3 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    placeholder="Enter your answer here" required> 
                                            </div>

                                        </div>

                                        <!-- Fourth column with 3/12 width -->
                                        {{-- <div class="col-span-2 bg-gray-200 p-2">EEMETRFD</div> --}}
                                    </div>
                                @endif
                            @endforeach
                        @endforeach



                        {{-- button --}}
                        <input type="hidden" name="surveyId" value="{{ $survey->id }}">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <div class="flex justify-end my-6 mx-4 gap-x-1">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Next Part IV
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
