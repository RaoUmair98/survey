<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .show {
            display: block !important;
        }
       
        .logout_test {
            position: fixed;
            bottom: 40px;
        }
    
        .dfg h2 {
            color: #060606;
            font-weight: 400;
            font-size: 16px;
            font-weight: 500;
        }
    
        .tabelo {
            background-color: white;
            padding-bottom: 20px;
            padding-top: 10px;
        }
    
        .sof {
            height: 100vh;
        }
    
        .toto span {
            color: #293240;
            font-size: 16px;
            font-weight: 400;
        }
    
        .bgh {
            background-color: #f4fbff;
        }
    
        /* ===========dashboard css============ */
       
        .dash_box{
            margin: 10px;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 25px 25px -5px rgba(40, 47, 50, 0.15), 0 10px 10px -5px rgba(40, 47, 50, 0.1);
        }
        .dashboard{
            margin: 0px 10px;
        }
        .dashboard .dd{
            color: #060606;
            font-weight: 400;
            font-size: 18px;
        }
        .dash_box h2{
            color: #FFFFFF;
            font-weight: 400;
            font-size: 24px;
        }
        .dash_box p{
            color: #FFFFFF;
            font-weight: 400;
            font-size: 16px;
        }
        .flex_btn{
            margin-top: 10px;
        }
        .flex_btn button{
            width: 64px;
            height: 24px;
            border-radius: 3px;
            color: #060606;
            font-weight: 400;
            font-size: 12px;
            background-color: #FFFFFF;
        }
        .flex_btn a{
            width: 64px;
            height: 24px;
            border-radius: 3px;
            color: #060606;
            padding: 2%;
            text-align: center;
            font-weight: 400;
            font-size: 12px;
            background-color: #FFFFFF;
        }
        .sjb{
            display: none;
            margin: 0px 22px !important;
        }
        .srt{
            width: 62px !important;
            position: fixed;
            background-color: #eeeeee !important;
            z-index: 99;
            /* padding: 5px 0px !important; */
        }
        @media only screen and (max-width:1100px){
            .dash_card{
                flex-wrap: wrap;
            }
        }

        @media only screen and (max-width:640px){
            .soro{
                display:none;
            }
            .sjb{
                display: block;
                width: 15px !important;
                height: 15px !important;
                margin: 0px 22px !important;
            }
            .srt{
            width: 62px !important;
            position: fixed;
            background: #eeeeee !important;
            padding: 5px 0px !important;
        }
        }
        .man{
            display:block !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <livewire:layout.navigation />
    <div class="sidebar">
        <div class="srt">
            <svg class="sjb" id="such" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        <aside id="sidebar-multi-level-sidebar"
            class="fixed top-15 left-0 z-40 soro w-64 h-[95vh] transition-transform sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-[#000F2B]">
                <ul class="space-y-2 font-medium">
                    @if (Auth::user()->role->id <= 3)
                    <li>
                        <a href="{{route('dashboard')}}"
                            class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <button onclick="func()" type="button"
                            class="flex items-center w-full p-2 text-base  transition duration-75 rounded-lg group text-gray-500 hover:text-white"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <!-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 21">
                                <path
                                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg> -->
                            <!-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white " width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 10.8333C5.50832 10.8333 4.7833 10.6134 4.16661 10.2013C3.54993 9.78929 3.06928 9.20362 2.78545 8.5184C2.50162 7.83318 2.42736 7.07918 2.57206 6.35175C2.71675 5.62432 3.0739 4.95613 3.59835 4.43168C4.1228 3.90724 4.79098 3.55008 5.51841 3.40539C6.24584 3.2607 6.99984 3.33496 7.68506 3.61879C8.37029 3.90262 8.95596 4.38326 9.36801 4.99995C9.78007 5.61663 10 6.34166 10 7.08334C9.9989 8.07756 9.60345 9.03075 8.90043 9.73377C8.19741 10.4368 7.24422 10.8322 6.25 10.8333ZM11.6667 20H0.833333C0.61232 20 0.400358 19.9122 0.244078 19.7559C0.0877974 19.5996 0 19.3877 0 19.1667V18.75C0 17.0924 0.65848 15.5027 1.83058 14.3306C3.00268 13.1585 4.5924 12.5 6.25 12.5C7.9076 12.5 9.49731 13.1585 10.6694 14.3306C11.8415 15.5027 12.5 17.0924 12.5 18.75V19.1667C12.5 19.3877 12.4122 19.5996 12.2559 19.7559C12.0996 19.9122 11.8877 20 11.6667 20ZM14.5833 7.5C13.8417 7.5 13.1166 7.28007 12.4999 6.86801C11.8833 6.45596 11.4026 5.87029 11.1188 5.18506C10.835 4.49984 10.7607 3.74584 10.9054 3.01841C11.0501 2.29098 11.4072 1.6228 11.9317 1.09835C12.4561 0.573904 13.1243 0.216751 13.8517 0.0720569C14.5792 -0.0726377 15.3332 0.00162482 16.0184 0.285453C16.7036 0.569282 17.2893 1.04993 17.7013 1.66661C18.1134 2.2833 18.3333 3.00832 18.3333 3.75C18.3322 4.74423 17.9368 5.69741 17.2338 6.40043C16.5307 7.10346 15.5776 7.4989 14.5833 7.5ZM13.3992 9.18417C12.623 9.2883 11.8767 9.55159 11.2071 9.95754C10.5374 10.3635 9.95882 10.9034 9.5075 11.5433C11.3749 12.3914 12.8422 13.9285 13.6025 15.8333H19.1667C19.3877 15.8333 19.5996 15.7455 19.7559 15.5893C19.9122 15.433 20 15.221 20 15V14.9683C19.9991 14.1377 19.8211 13.3168 19.4777 12.5604C19.1344 11.804 18.6336 11.1296 18.0088 10.5821C17.3841 10.0347 16.6498 9.62681 15.8549 9.38574C15.0599 9.14467 14.2227 9.07595 13.3992 9.18417Z" fill="white"/>
                                </svg> -->
                            <!-- ms-3 dena hai -->

                            <span class="flex-1  text-left rtl:text-right whitespace-nowrap">User Management</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>

                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">

                            <li class="flex">
                                <a href="{{route('UserManagement',['role_id' => 1])}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                    <span class="ms-3">All Users</span>
                                </a>
                            </li>
                            @if(Auth::user()->role->id == 1)
                            <li class="flex">
                                <a href="{{route('UserManagement',['role_id' => 3])}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                    <span class="ms-3">All Manager</span>
                                </a>
                            </li>
                            <li class="flex">
                                <a href="{{route('UserManagement',['role_id' => 2])}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                    <span class="ms-3">All Director</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <button onclick="func1()" type="button"
                            class="flex items-center w-full p-2 text-base  transition duration-75 rounded-lg group text-gray-500 hover:text-white"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <!-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white "
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 21">
                                <path
                                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg> -->
                            <!-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white " width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 10.8333C5.50832 10.8333 4.7833 10.6134 4.16661 10.2013C3.54993 9.78929 3.06928 9.20362 2.78545 8.5184C2.50162 7.83318 2.42736 7.07918 2.57206 6.35175C2.71675 5.62432 3.0739 4.95613 3.59835 4.43168C4.1228 3.90724 4.79098 3.55008 5.51841 3.40539C6.24584 3.2607 6.99984 3.33496 7.68506 3.61879C8.37029 3.90262 8.95596 4.38326 9.36801 4.99995C9.78007 5.61663 10 6.34166 10 7.08334C9.9989 8.07756 9.60345 9.03075 8.90043 9.73377C8.19741 10.4368 7.24422 10.8322 6.25 10.8333ZM11.6667 20H0.833333C0.61232 20 0.400358 19.9122 0.244078 19.7559C0.0877974 19.5996 0 19.3877 0 19.1667V18.75C0 17.0924 0.65848 15.5027 1.83058 14.3306C3.00268 13.1585 4.5924 12.5 6.25 12.5C7.9076 12.5 9.49731 13.1585 10.6694 14.3306C11.8415 15.5027 12.5 17.0924 12.5 18.75V19.1667C12.5 19.3877 12.4122 19.5996 12.2559 19.7559C12.0996 19.9122 11.8877 20 11.6667 20ZM14.5833 7.5C13.8417 7.5 13.1166 7.28007 12.4999 6.86801C11.8833 6.45596 11.4026 5.87029 11.1188 5.18506C10.835 4.49984 10.7607 3.74584 10.9054 3.01841C11.0501 2.29098 11.4072 1.6228 11.9317 1.09835C12.4561 0.573904 13.1243 0.216751 13.8517 0.0720569C14.5792 -0.0726377 15.3332 0.00162482 16.0184 0.285453C16.7036 0.569282 17.2893 1.04993 17.7013 1.66661C18.1134 2.2833 18.3333 3.00832 18.3333 3.75C18.3322 4.74423 17.9368 5.69741 17.2338 6.40043C16.5307 7.10346 15.5776 7.4989 14.5833 7.5ZM13.3992 9.18417C12.623 9.2883 11.8767 9.55159 11.2071 9.95754C10.5374 10.3635 9.95882 10.9034 9.5075 11.5433C11.3749 12.3914 12.8422 13.9285 13.6025 15.8333H19.1667C19.3877 15.8333 19.5996 15.7455 19.7559 15.5893C19.9122 15.433 20 15.221 20 15V14.9683C19.9991 14.1377 19.8211 13.3168 19.4777 12.5604C19.1344 11.804 18.6336 11.1296 18.0088 10.5821C17.3841 10.0347 16.6498 9.62681 15.8549 9.38574C15.0599 9.14467 14.2227 9.07595 13.3992 9.18417Z" fill="white"/>
                                </svg> -->

                            <span class="flex-1  text-left rtl:text-right whitespace-nowrap">Survey
                                Management</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>

                        </button>
                        <ul id="dropdown-example1" class="hidden py-2 space-y-2">

                            <li class="flex">
                                <a href="{{route('allSurvay')}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 16 20">
                                        <path
                                            d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                    </svg>
                                    <span class="ms-3">Manage Survey</span>
                                </a>
                            </li>

                            <li class="flex">
                                <a href="{{route('responseSurvay')}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 16 20">
                                        <path
                                            d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                                    </svg>
                                    <span class="ms-3">View Survey Response</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role->id != 1 )
                    <li>
                        <button onclick="func2()" type="button"
                            class="flex items-center w-full p-2 text-base  transition duration-75 rounded-lg group text-gray-500 hover:text-white"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        
                            <span class="flex-1  text-left rtl:text-right whitespace-nowrap">Your Surveys</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>

                        </button>
                        <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                            @foreach (Auth::user()->userSurveys as $userSurvey)
                                
                            <li class="flex">
                                <a href="{{route('survey',['surveyId' => $userSurvey->survey->id])}}"
                                    class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                    <span class="ms-3">{{$userSurvey->survey->title}}</span>
                                </a>
                            </li>

                            @endforeach
                           
                        </ul>
                    </li>
                    @endif


                </ul>
                <div class="logout_test">
                    <a href="#"
                        class="flex items-center p-2 text-gray-500 hover:text-white rounded-lg dark:text-white  group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75  group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 21 21">
                            <path
                                d="m5.4 2.736 3.429 3.429A5.046 5.046 0 0 1 10.134 6c.356.01.71.06 1.056.147l3.41-3.412c.136-.133.287-.248.45-.344A9.889 9.889 0 0 0 10.269 1c-1.87-.041-3.713.44-5.322 1.392a2.3 2.3 0 0 1 .454.344Zm11.45 1.54-.126-.127a.5.5 0 0 0-.706 0l-2.932 2.932c.029.023.049.054.078.077.236.194.454.41.65.645.034.038.078.067.11.107l2.927-2.927a.5.5 0 0 0 0-.707Zm-2.931 9.81c-.024.03-.057.052-.081.082a4.963 4.963 0 0 1-.633.639c-.041.036-.072.083-.115.117l2.927 2.927a.5.5 0 0 0 .707 0l.127-.127a.5.5 0 0 0 0-.707l-2.932-2.931Zm-1.442-4.763a3.036 3.036 0 0 0-1.383-1.1l-.012-.007a2.955 2.955 0 0 0-1-.213H10a2.964 2.964 0 0 0-2.122.893c-.285.29-.509.634-.657 1.013l-.01.016a2.96 2.96 0 0 0-.21 1 2.99 2.99 0 0 0 .489 1.716c.009.014.022.026.032.04a3.04 3.04 0 0 0 1.384 1.1l.012.007c.318.129.657.2 1 .213.392.015.784-.05 1.15-.192.012-.005.02-.013.033-.018a3.011 3.011 0 0 0 1.676-1.7v-.007a2.89 2.89 0 0 0 0-2.207 2.868 2.868 0 0 0-.27-.515c-.007-.012-.02-.025-.03-.039Zm6.137-3.373a2.53 2.53 0 0 1-.35.447L14.84 9.823c.112.428.166.869.16 1.311-.01.356-.06.709-.147 1.054l3.413 3.412c.132.134.249.283.347.444A9.88 9.88 0 0 0 20 11.269a9.912 9.912 0 0 0-1.386-5.319ZM14.6 19.264l-3.421-3.421c-.385.1-.781.152-1.18.157h-.134c-.356-.01-.71-.06-1.056-.147l-3.41 3.412a2.503 2.503 0 0 1-.443.347A9.884 9.884 0 0 0 9.732 21H10a9.9 9.9 0 0 0 5.044-1.388 2.519 2.519 0 0 1-.444-.348ZM1.735 15.6l3.426-3.426a4.608 4.608 0 0 1-.013-2.367L1.735 6.4a2.507 2.507 0 0 1-.35-.447 9.889 9.889 0 0 0 0 10.1c.1-.164.217-.316.35-.453Zm5.101-.758a4.957 4.957 0 0 1-.651-.645c-.033-.038-.077-.067-.11-.107L3.15 17.017a.5.5 0 0 0 0 .707l.127.127a.5.5 0 0 0 .706 0l2.932-2.933c-.03-.018-.05-.053-.078-.076ZM6.08 7.914c.03-.037.07-.063.1-.1.183-.22.384-.423.6-.609.047-.04.082-.092.129-.13L3.983 4.149a.5.5 0 0 0-.707 0l-.127.127a.5.5 0 0 0 0 .707L6.08 7.914Z" />
                        </svg>
                        <span class="ms-3">Logout</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
        <div class="sm:ml-64">
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

    </div>


    @livewireScripts
    <script>
        const func = () => {
           
            document.getElementById("dropdown-example").classList.toggle("show");
        }
        const func1 = () => {
            
            document.getElementById("dropdown-example1").classList.toggle("show");
        }
        const func2 = () => {
            
            document.getElementById("dropdown-example2").classList.toggle("show");
        }

        const such = document.getElementById("such");
        const sira = document.getElementById("sidebar-multi-level-sidebar");
        such.addEventListener("click",()=>{
             sira.classList.toggle("man");
        })
    </script>

</body>

</html>
