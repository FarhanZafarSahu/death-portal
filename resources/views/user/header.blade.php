<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{asset('assets/images/logo.svg')}}" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                   

                        <li class='sidebar-title'>User Panel</li>
                        <p class='sidebar-title'>Profile Progress Bar</p>
                        @php
                        $percentage = percentage();
                        @endphp
                        <div class="progress" style="margin:0 10px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%;">
                            </div>
                        </div>
                        <p style="margin-left:10px">{{$percentage}}% Complete</p>

                        <li class="sidebar-item ">
                            <a href="{{route('user.dashboard')}}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i>
                                <span>Form</span>
                            </a>

                            <ul class="submenu ">
                                @php
                                $form = allform();
                                @endphp
                                @foreach($form as $forms)
                                <li>
                                    <a href="{{ route('user.form', ['id' => $forms->id]) }}">{{$forms->name}}</a>
                                </li>
                                @endforeach
                            </ul>

                        </li>
                        
                        @if(count(auth()->user()->profiles) != 0)
                            <li class="sidebar-item">
                                <a href="{{ route('user.contact') }}" class='sidebar-link'>
                                    <i data-feather="triangle" width="20"></i>
                                    <span>Profiles</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a href="{{route('all.user')}}" class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i>
                                <span>Regitser a Death</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i>
                                <span>Complete Forms</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{route('user.logout')}}" class='sidebar-link'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Logout</span>
                            </a>

                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>