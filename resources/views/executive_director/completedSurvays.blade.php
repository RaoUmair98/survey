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
                          {{ Auth::user()->role->role_name }} DashBoard
                      </a>
                      <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                          xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round">
                          <path d="m9 18 6-6-6-6" />
                      </svg>
                  </li>
                  <li class="inline-flex items-center sd text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                      aria-current="page">
                      View Survey Response
                  </li>
              </ol>
          </div>
          <div class="trd">
              <a href="{{ route('addUser') }}"
                  class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                      fill="currentColor">
                      <path fill-rule="evenodd"
                          d="M5 3a1 1 0 011-1h8a1 1 0 011 1v2h3a1 1 0 011 1v12a1 1 0 01-1 1H6a1 1 0 01-1-1V6a1 1 0 011-1h3V3zm5 2H6v12h9V5h-3zM8 8a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1z"
                          clip-rule="evenodd" />
                  </svg>
                  Create Survey
              </a>
          </div>
      </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-100 text-sm">
              <div class="p-6 text-gray-900 dark:text-gray-100">
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

                  <table class="min-w-full divide-y divide-gray-200">
                      <thead>
                          <tr>
                              <th
                                  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  #</th>
                              <th
                                  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Employee Name</th>
                              <th
                                  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Survey Name</th>
                              <th
                                  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Progress</th>
                              <th
                                  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Action</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($percentage as $percentages)

                            @if($percentages === 100)
                                @if($usersurveys === null)
                                            <p>User not found</p>
                                        @else
                                        @php $counter = 1; @endphp
                                            @foreach ($usersurveys as $usersurvey)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $counter }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $names[$usersurvey->survey_id] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $titles[$usersurvey->survey_id] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="min-w-[10rem] h-4 bg-gray-200 rounded-full">
                                                        <div class="h-full text-center text-xs text-white bg-green-500 rounded-full"
                                                            style="width: {{ $usersurvey->percentCompleted }}%;">
                                                            {{ $usersurvey->percentCompleted }}%</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <a type="button"
                                                        href="{{ route('manager.survey', ['surveyId' => $usersurvey->survey_id, 'userId' => $usersurvey->user_id]) }}"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.8806 7.454C15.2952 6.174 12.9999 2 7.99991 2C2.99991 2 0.704581 6.174 0.119247 7.454C0.040673 7.62553 0 7.81199 0 8.00067C0 8.18934 0.040673 8.3758 0.119247 8.54733C0.704581 9.826 2.99991 14 7.99991 14C12.9999 14 15.2952 9.826 15.8806 8.546C15.959 8.37466 15.9996 8.18843 15.9996 8C15.9996 7.81157 15.959 7.62534 15.8806 7.454ZM7.99991 12C7.20879 12 6.43543 11.7654 5.77763 11.3259C5.11984 10.8864 4.60715 10.2616 4.3044 9.53073C4.00165 8.79983 3.92243 7.99556 4.07677 7.21964C4.23111 6.44372 4.61208 5.73098 5.17149 5.17157C5.7309 4.61216 6.44363 4.2312 7.21955 4.07686C7.99548 3.92252 8.79974 4.00173 9.53065 4.30448C10.2616 4.60723 10.8863 5.11992 11.3258 5.77772C11.7653 6.43552 11.9999 7.20887 11.9999 8C11.9989 9.06054 11.5771 10.0773 10.8272 10.8273C10.0773 11.5772 9.06045 11.9989 7.99991 12Z"
                                                                fill="white" />
                                                            <path
                                                                d="M7.99992 10.6667C9.47268 10.6667 10.6666 9.47276 10.6666 8C10.6666 6.52724 9.47268 5.33334 7.99992 5.33334C6.52716 5.33334 5.33325 6.52724 5.33325 8C5.33325 9.47276 6.52716 10.6667 7.99992 10.6667Z"
                                                                fill="white" />
                                                        </svg>
                                                    </a>
                                                        {{-- <a type="button" href=""
                                                            class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-2 rounded">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_82_94)">
                                                                    <path
                                                                        d="M3.68066 13.2667H7.22866L9.57466 15.61C9.70075 15.7368 9.85064 15.8374 10.0157 15.906C10.1808 15.9747 10.3579 16.01 10.5367 16.01C10.6543 16.0098 10.7714 15.9948 10.8853 15.9653C11.1155 15.9072 11.3263 15.7895 11.4964 15.624C11.6666 15.4585 11.7902 15.2511 11.8547 15.0227L15.9927 0.949997L3.68066 13.2667Z"
                                                                        fill="white" />
                                                                    <path
                                                                        d="M2.72485 12.3333L15.0482 0.00800323L0.985519 4.15534C0.756543 4.22045 0.548571 4.34431 0.382236 4.51461C0.215902 4.68491 0.0969854 4.89575 0.0372847 5.12619C-0.0224161 5.35664 -0.0208262 5.59869 0.0418965 5.82834C0.104619 6.05798 0.226295 6.26723 0.394852 6.43534L2.72485 8.76334V12.3333Z"
                                                                        fill="white" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_82_94">
                                                                        <rect width="16" height="16" fill="white" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a> --}}
                                                    @if(Auth::user()->role->role_id >=2)
                                                    <a type="button" href="{{'/survey/'.$usersurvey->user->name.'/'.$usersurvey->user->id.'/employee_progress'}}"
                                                        class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-1 px-2 rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                        </svg>

                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-100 text-sm">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  {{ $usersurveys->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
