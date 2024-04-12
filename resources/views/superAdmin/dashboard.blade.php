<style>
    .flex_btn a{
        height:auto !important;
        padding:6px 12px !important;
        width:auto !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Auth::user()->role->role_name }} {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a.667.667 0 1 1-.94.94l-3.058-3.058-3.05 3.05a.667.667 0 0 1-.94-.94l3.05-3.05-3.05-3.058a.667.667 0 1 1 .94-.94l3.05 3.05 3.058-3.05a.667.667 0 1 1 .94.94l-3.05 3.05 3.05 3.058z" />
                        </svg>
                    </span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a.667.667 0 1 1-.94.94l-3.058-3.058-3.05 3.05a.667.667 0 0 1-.94-.94l3.05-3.05-3.05-3.058a.667.667 0 1 1 .94-.94l3.05 3.05 3.058-3.05a.667.667 0 1 1 .94.94l-3.05 3.05 3.05 3.058z" />
                        </svg>
                    </span>
                </div>
            @endif

            @if (Auth::user()->role->id <= 3)
                <div class="dash_cards mt-2">
                    <div class="dash_card flex items-center justify-center">
                        <div class="dash_box w-[100%] d1 bg-[#0081CA] shadow-xl">
                            <div class="num">
                                @if (Auth::user()->role->id == 1)
                                <h2>{{ $user_surveys->where('percentCompleted', '=', 100)->count() }}</h2>
                                @else
                                    <h2>{{ Auth::user()->subordinates()->where('survayCompleted', true)->count() }}</h2>
                                @endif
                            </div>
                            <div class="txt">
                                <p>Completed Survey</p>
                            </div>
                            <div class="flex_btn flex items-center justify-between">
                                <a href="dashboard/responseSurvey">View All</a>
                                <svg width="39" height="44" viewBox="0 0 39 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.5">
                                        <g clip-path="url(#clip0_51_638)">
                                            <path
                                                d="M-0.00148449 21.9518C-0.00148449 16.5931 -0.00335904 11.2325 0.000390062 5.87384C0.00413916 2.50865 2.32483 0.0368935 5.62779 0.0254147C14.8731 -0.00710845 24.1202 -0.00710845 33.3655 0.0254147C36.6741 0.0368935 38.9948 2.50291 38.9948 5.87002C38.9985 16.6218 38.9985 27.3717 38.9948 38.1234C38.9948 41.4561 36.7228 43.947 33.463 43.9642C24.1558 44.0139 14.8468 44.0139 5.53781 43.9642C2.28172 43.947 0.00413916 41.4542 0.000390062 38.1253C-0.00335904 32.7341 0.000390062 27.343 0.000390062 21.9518H-0.00148449ZM10.4379 33.8112C10.0667 33.354 9.82115 33.023 9.5456 32.7169C9.24942 32.3879 8.94012 32.0703 8.61769 31.7699C7.84725 31.0544 6.99059 31.0429 6.37573 31.724C5.80774 32.3553 5.85461 33.2296 6.53132 33.9413C7.38049 34.8348 8.24841 35.7091 9.11445 36.5834C10.0986 37.5782 10.7622 37.5935 11.7557 36.6063C13.3697 35.005 14.9743 33.3942 16.5602 31.7661C16.787 31.5327 16.9819 31.196 17.04 30.8765C17.1694 30.1839 16.8995 29.6291 16.2715 29.2886C15.5891 28.9175 14.9893 29.1049 14.4813 29.6215C13.1785 30.9492 11.8963 32.2941 10.4341 33.8093L10.4379 33.8112ZM10.4772 22.5066C9.83053 21.8217 9.26254 21.1961 8.66643 20.5973C7.94661 19.8741 7.04307 19.8301 6.43197 20.4557C5.79837 21.1023 5.83024 21.9671 6.55569 22.7342C7.4461 23.6736 8.35151 24.5976 9.27191 25.5044C10.0573 26.2773 10.8559 26.2716 11.6507 25.4815C13.3041 23.8362 14.9462 22.1775 16.577 20.5074C17.175 19.8952 17.1694 19.061 16.6183 18.4488C16.0971 17.8691 15.2199 17.7984 14.59 18.3092C14.3463 18.5062 14.1364 18.7473 13.917 18.973C12.7998 20.1209 11.6826 21.2688 10.4772 22.5085V22.5066ZM10.5222 11.3148C9.93925 10.672 9.46686 10.1229 8.96636 9.60635C8.18842 8.80284 7.31488 8.71484 6.67566 9.34999C5.97645 10.0445 6.05706 10.8614 6.91935 11.7491C7.6673 12.5181 8.41524 13.2872 9.17069 14.0505C10.1398 15.0301 10.8465 15.0339 11.8157 14.0716C13.4259 12.4722 15.0755 10.9073 16.6145 9.23903C16.9294 8.8985 17.0363 8.09307 16.8845 7.62244C16.5395 6.54918 15.3192 6.39613 14.44 7.26851C13.1654 8.535 11.9394 9.84932 10.526 11.3148H10.5222ZM26.5271 12.8089C28.0868 12.8089 29.6464 12.8147 31.206 12.807C32.3083 12.8013 32.9812 12.2216 32.9962 11.2976C33.0112 10.3678 32.3326 9.74793 31.2491 9.7441C28.098 9.73453 24.9469 9.73645 21.7977 9.7441C20.6635 9.74601 20.0431 10.2893 20.0318 11.2536C20.0206 12.2503 20.6579 12.8032 21.8483 12.8089C23.4079 12.8166 24.9675 12.8089 26.5271 12.8089ZM26.4953 24.0639C27.68 24.0639 28.8647 24.0639 30.0494 24.0639C30.5162 24.0639 30.9867 24.0887 31.4516 24.0524C32.3832 23.9778 33.0206 23.3063 32.9981 22.4702C32.9737 21.6189 32.3326 21.0162 31.3691 21.0124C28.0961 20.999 24.8232 20.999 21.5502 21.0143C20.6523 21.0182 20.0993 21.5519 20.0375 22.365C19.9718 23.2412 20.4667 23.8783 21.3553 24.0313C21.5989 24.0734 21.852 24.0619 22.1013 24.0619C23.5672 24.0639 25.0312 24.0619 26.4971 24.0619L26.4953 24.0639ZM26.5328 35.248C28.1224 35.248 29.712 35.2595 31.3016 35.2442C32.3382 35.2346 32.9887 34.6454 32.9981 33.7577C33.0056 32.8891 32.3326 32.208 31.3316 32.2004C28.0905 32.1774 24.8475 32.1736 21.6064 32.2042C20.5773 32.2138 19.9981 32.8738 20.0337 33.817C20.0674 34.7028 20.6542 35.2327 21.6702 35.2442C23.2917 35.2595 24.9113 35.248 26.5328 35.248Z"
                                                fill="white" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_51_638">
                                            <rect width="39" height="44" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </div>
                        </div>
                        <div class="dash_box w-[100%] d2 bg-[#00A96E] shadow-xl">
                            <div class="num">
                                @if (Auth::user()->role->id == 1)
                                    <h2>{{ $user_surveys->where('percentCompleted', '<', 100)->where('percentCompleted', '>', 0)->count() }}</h2>
                                @else
                                    <h2>{{ Auth::user()->subordinates()->where('isSurveyStarted', true)->count() }}</h2>
                                @endif
                            </div>  
                            <div class="txt">
                                <p>In Progress Surveys</p>
                            </div>
                            <div class="flex_btn flex items-center justify-between">
                                <a href="dashboard/responseSurvey">View All</a>
                                <svg width="39" height="44" viewBox="0 0 39 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.5">
                                        <g clip-path="url(#clip0_51_646)">
                                            <path
                                                d="M-0.00148449 21.9518C-0.00148449 16.5931 -0.00335904 11.2325 0.000390062 5.87384C0.00413916 2.50865 2.32483 0.0368935 5.62779 0.0254147C14.8731 -0.00710845 24.1202 -0.00710845 33.3655 0.0254147C36.6741 0.0368935 38.9948 2.50291 38.9948 5.87002C38.9985 16.6218 38.9985 27.3717 38.9948 38.1234C38.9948 41.4561 36.7228 43.947 33.463 43.9642C24.1558 44.0139 14.8468 44.0139 5.53781 43.9642C2.28172 43.947 0.00413916 41.4542 0.000390062 38.1253C-0.00335904 32.7341 0.000390062 27.343 0.000390062 21.9518H-0.00148449ZM10.4379 33.8112C10.0667 33.354 9.82115 33.023 9.5456 32.7169C9.24942 32.3879 8.94012 32.0703 8.61769 31.7699C7.84725 31.0544 6.99059 31.0429 6.37573 31.724C5.80774 32.3553 5.85461 33.2296 6.53132 33.9413C7.38049 34.8348 8.24841 35.7091 9.11445 36.5834C10.0986 37.5782 10.7622 37.5935 11.7557 36.6063C13.3697 35.005 14.9743 33.3942 16.5602 31.7661C16.787 31.5327 16.9819 31.196 17.04 30.8765C17.1694 30.1839 16.8995 29.6291 16.2715 29.2886C15.5891 28.9175 14.9893 29.1049 14.4813 29.6215C13.1785 30.9492 11.8963 32.2941 10.4341 33.8093L10.4379 33.8112ZM10.4772 22.5066C9.83053 21.8217 9.26254 21.1961 8.66643 20.5973C7.94661 19.8741 7.04307 19.8301 6.43197 20.4557C5.79837 21.1023 5.83024 21.9671 6.55569 22.7342C7.4461 23.6736 8.35151 24.5976 9.27191 25.5044C10.0573 26.2773 10.8559 26.2716 11.6507 25.4815C13.3041 23.8362 14.9462 22.1775 16.577 20.5074C17.175 19.8952 17.1694 19.061 16.6183 18.4488C16.0971 17.8691 15.2199 17.7984 14.59 18.3092C14.3463 18.5062 14.1364 18.7473 13.917 18.973C12.7998 20.1209 11.6826 21.2688 10.4772 22.5085V22.5066ZM10.5222 11.3148C9.93925 10.672 9.46686 10.1229 8.96636 9.60635C8.18842 8.80284 7.31488 8.71484 6.67566 9.34999C5.97645 10.0445 6.05706 10.8614 6.91935 11.7491C7.6673 12.5181 8.41524 13.2872 9.17069 14.0505C10.1398 15.0301 10.8465 15.0339 11.8157 14.0716C13.4259 12.4722 15.0755 10.9073 16.6145 9.23903C16.9294 8.8985 17.0363 8.09307 16.8845 7.62244C16.5395 6.54918 15.3192 6.39613 14.44 7.26851C13.1654 8.535 11.9394 9.84932 10.526 11.3148H10.5222ZM26.5271 12.8089C28.0868 12.8089 29.6464 12.8147 31.206 12.807C32.3083 12.8013 32.9812 12.2216 32.9962 11.2976C33.0112 10.3678 32.3326 9.74793 31.2491 9.7441C28.098 9.73453 24.9469 9.73645 21.7977 9.7441C20.6635 9.74601 20.0431 10.2893 20.0318 11.2536C20.0206 12.2503 20.6579 12.8032 21.8483 12.8089C23.4079 12.8166 24.9675 12.8089 26.5271 12.8089ZM26.4953 24.0639C27.68 24.0639 28.8647 24.0639 30.0494 24.0639C30.5162 24.0639 30.9867 24.0887 31.4516 24.0524C32.3832 23.9778 33.0206 23.3063 32.9981 22.4702C32.9737 21.6189 32.3326 21.0162 31.3691 21.0124C28.0961 20.999 24.8232 20.999 21.5502 21.0143C20.6523 21.0182 20.0993 21.5519 20.0375 22.365C19.9718 23.2412 20.4667 23.8783 21.3553 24.0313C21.5989 24.0734 21.852 24.0619 22.1013 24.0619C23.5672 24.0639 25.0312 24.0619 26.4971 24.0619L26.4953 24.0639ZM26.5328 35.248C28.1224 35.248 29.712 35.2595 31.3016 35.2442C32.3382 35.2346 32.9887 34.6454 32.9981 33.7577C33.0056 32.8891 32.3326 32.208 31.3316 32.2004C28.0905 32.1774 24.8475 32.1736 21.6064 32.2042C20.5773 32.2138 19.9981 32.8738 20.0337 33.817C20.0674 34.7028 20.6542 35.2327 21.6702 35.2442C23.2917 35.2595 24.9113 35.248 26.5328 35.248Z"
                                                fill="white" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_51_646">
                                            <rect width="39" height="44" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>


                            </div>
                        </div>
                        <div class="dash_box w-[100%] d3 bg-[#FF5861] shadow-xl">
                            <div class="num">
                                @if (Auth::user()->role->id == 1)
                                  <h2>{{ $user_surveys->where('percentCompleted', '=', 0)->count() }}</h2>
                                @else
                                    <h2>{{ Auth::user()->subordinates()->where('inviteSend', true)->where('isSurveyStarted', false)->count() }}
                                    </h2>
                                @endif
                            </div>
                            <div class="txt">
                                <p>Not Started Surveys</p>
                            </div>
                            <div class="flex_btn flex items-center justify-between">
                                <a href="dashboard/responseSurvey">View All</a>
                                <svg width="39" height="44" viewBox="0 0 39 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.5">
                                        <g clip-path="url(#clip0_51_656)">
                                            <path
                                                d="M-0.00148449 21.9518C-0.00148449 16.5931 -0.00335904 11.2325 0.000390062 5.87384C0.00413916 2.50865 2.32483 0.0368935 5.62779 0.0254147C14.8731 -0.00710845 24.1202 -0.00710845 33.3655 0.0254147C36.6741 0.0368935 38.9948 2.50291 38.9948 5.87002C38.9985 16.6218 38.9985 27.3717 38.9948 38.1234C38.9948 41.4561 36.7228 43.947 33.463 43.9642C24.1558 44.0139 14.8468 44.0139 5.53781 43.9642C2.28172 43.947 0.00413916 41.4542 0.000390062 38.1253C-0.00335904 32.7341 0.000390062 27.343 0.000390062 21.9518H-0.00148449ZM10.4379 33.8112C10.0667 33.354 9.82115 33.023 9.5456 32.7169C9.24942 32.3879 8.94012 32.0703 8.61769 31.7699C7.84725 31.0544 6.99059 31.0429 6.37573 31.724C5.80774 32.3553 5.85461 33.2296 6.53132 33.9413C7.38049 34.8348 8.24841 35.7091 9.11445 36.5834C10.0986 37.5782 10.7622 37.5935 11.7557 36.6063C13.3697 35.005 14.9743 33.3942 16.5602 31.7661C16.787 31.5327 16.9819 31.196 17.04 30.8765C17.1694 30.1839 16.8995 29.6291 16.2715 29.2886C15.5891 28.9175 14.9893 29.1049 14.4813 29.6215C13.1785 30.9492 11.8963 32.2941 10.4341 33.8093L10.4379 33.8112ZM10.4772 22.5066C9.83053 21.8217 9.26254 21.1961 8.66643 20.5973C7.94661 19.8741 7.04307 19.8301 6.43197 20.4557C5.79837 21.1023 5.83024 21.9671 6.55569 22.7342C7.4461 23.6736 8.35151 24.5976 9.27191 25.5044C10.0573 26.2773 10.8559 26.2716 11.6507 25.4815C13.3041 23.8362 14.9462 22.1775 16.577 20.5074C17.175 19.8952 17.1694 19.061 16.6183 18.4488C16.0971 17.8691 15.2199 17.7984 14.59 18.3092C14.3463 18.5062 14.1364 18.7473 13.917 18.973C12.7998 20.1209 11.6826 21.2688 10.4772 22.5085V22.5066ZM10.5222 11.3148C9.93925 10.672 9.46686 10.1229 8.96636 9.60635C8.18842 8.80284 7.31488 8.71484 6.67566 9.34999C5.97645 10.0445 6.05706 10.8614 6.91935 11.7491C7.6673 12.5181 8.41524 13.2872 9.17069 14.0505C10.1398 15.0301 10.8465 15.0339 11.8157 14.0716C13.4259 12.4722 15.0755 10.9073 16.6145 9.23903C16.9294 8.8985 17.0363 8.09307 16.8845 7.62244C16.5395 6.54918 15.3192 6.39613 14.44 7.26851C13.1654 8.535 11.9394 9.84932 10.526 11.3148H10.5222ZM26.5271 12.8089C28.0868 12.8089 29.6464 12.8147 31.206 12.807C32.3083 12.8013 32.9812 12.2216 32.9962 11.2976C33.0112 10.3678 32.3326 9.74793 31.2491 9.7441C28.098 9.73453 24.9469 9.73645 21.7977 9.7441C20.6635 9.74601 20.0431 10.2893 20.0318 11.2536C20.0206 12.2503 20.6579 12.8032 21.8483 12.8089C23.4079 12.8166 24.9675 12.8089 26.5271 12.8089ZM26.4953 24.0639C27.68 24.0639 28.8647 24.0639 30.0494 24.0639C30.5162 24.0639 30.9867 24.0887 31.4516 24.0524C32.3832 23.9778 33.0206 23.3063 32.9981 22.4702C32.9737 21.6189 32.3326 21.0162 31.3691 21.0124C28.0961 20.999 24.8232 20.999 21.5502 21.0143C20.6523 21.0182 20.0993 21.5519 20.0375 22.365C19.9718 23.2412 20.4667 23.8783 21.3553 24.0313C21.5989 24.0734 21.852 24.0619 22.1013 24.0619C23.5672 24.0639 25.0312 24.0619 26.4971 24.0619L26.4953 24.0639ZM26.5328 35.248C28.1224 35.248 29.712 35.2595 31.3016 35.2442C32.3382 35.2346 32.9887 34.6454 32.9981 33.7577C33.0056 32.8891 32.3326 32.208 31.3316 32.2004C28.0905 32.1774 24.8475 32.1736 21.6064 32.2042C20.5773 32.2138 19.9981 32.8738 20.0337 33.817C20.0674 34.7028 20.6542 35.2327 21.6702 35.2442C23.2917 35.2595 24.9113 35.248 26.5328 35.248Z"
                                                fill="white" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_51_656">
                                            <rect width="39" height="44" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="dash_box w-[100%] d4 bg-[#0081CA] shadow-xl">
                            <div class="num">
                                @if (Auth::user()->role->id == 1)
                                    <h2>{{ $allUsers->count() }}</h2>
                                @else
                                    <h2>{{ Auth::user()->subordinates()->count() }}</h2>
                                @endif
                            </div>
                            <div class="txt">
                                <p>Total Employees</p>
                            </div>  
                            <div class="flex_btn flex items-center justify-between">
                                <a type="button" href="{{ route('UserManagement', ['role_id' => 1]) }}">View All</a>
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.5">
                                        <g clip-path="url(#clip0_51_686)">
                                            <path
                                                d="M13.75 23.8333C12.1183 23.8333 10.5233 23.3495 9.16654 22.443C7.80984 21.5364 6.75242 20.248 6.12799 18.7405C5.50357 17.233 5.34019 15.5742 5.65852 13.9738C5.97685 12.3735 6.76259 10.9035 7.91637 9.74971C9.07015 8.59592 10.5402 7.81019 12.1405 7.49186C13.7408 7.17353 15.3996 7.33691 16.9071 7.96133C18.4146 8.58575 19.7031 9.64318 20.6096 10.9999C21.5161 12.3566 22 13.9516 22 15.5833C21.9976 17.7706 21.1276 19.8676 19.581 21.4143C18.0343 22.9609 15.9373 23.8309 13.75 23.8333ZM25.6667 44H1.83333C1.3471 44 0.880788 43.8069 0.536971 43.463C0.193154 43.1192 0 42.6529 0 42.1667V41.25C0 37.6033 1.44866 34.1059 4.02728 31.5273C6.60591 28.9487 10.1033 27.5 13.75 27.5C17.3967 27.5 20.8941 28.9487 23.4727 31.5273C26.0513 34.1059 27.5 37.6033 27.5 41.25V42.1667C27.5 42.6529 27.3068 43.1192 26.963 43.463C26.6192 43.8069 26.1529 44 25.6667 44ZM32.0833 16.5C30.4516 16.5 28.8566 16.0161 27.4999 15.1096C26.1432 14.2031 25.0858 12.9146 24.4613 11.4071C23.8369 9.89965 23.6735 8.24085 23.9919 6.64051C24.3102 5.04016 25.0959 3.57016 26.2497 2.41637C27.4035 1.26259 28.8735 0.476853 30.4738 0.158525C32.0742 -0.159803 33.733 0.00357461 35.2405 0.627998C36.748 1.25242 38.0364 2.30984 38.943 3.66655C39.8495 5.02325 40.3333 6.61831 40.3333 8.25C40.3309 10.4373 39.4609 12.5343 37.9143 14.081C36.3676 15.6276 34.2706 16.4976 32.0833 16.5ZM29.4782 20.2052C27.7707 20.4343 26.1288 21.0135 24.6556 21.9066C23.1823 22.7997 21.9094 23.9874 20.9165 25.3953C25.0248 27.261 28.2528 30.6427 29.9255 34.8333H42.1667C42.6529 34.8333 43.1192 34.6402 43.463 34.2964C43.8068 33.9526 44 33.4862 44 33V32.9303C43.9981 31.1029 43.6064 29.2969 42.851 27.6328C42.0956 25.9688 40.9939 24.4851 39.6195 23.2807C38.245 22.0763 36.6295 21.179 34.8807 20.6486C33.1319 20.1183 31.2901 19.9671 29.4782 20.2052Z"
                                                fill="white" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_51_686">
                                            <rect width="44" height="44" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-2xl font-extrabold"> Hi, {{ Auth::user()->name }} {{ __("You're logged in!") }}</p>
                        {{-- <p><span class="text-green-600 capitalize">Manager : {{ Auth::user()->getManager()->name }}</span></p> --}}
                    </div>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
