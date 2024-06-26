<header class="admin-header bg-dark row media-ml10">
    <a href="#" class="col-md-1 menu-open-close" id="left-control"><i class="mdi mdi-format-indent-decrease"></i> </a>
    <div class="col-md-10 menu-title">
        <span class="fw-bold" >{{ $title ?? '' }}</span>
    </div>
    <nav class="col-md-1 menu-logout">
        <ul class="nav align-items-center">
            <li class="nav-item">
                <div class="dropdown">
                    <!-- <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        {{-- <span class="notification-counter"></span> --}}
                    </a> -->
                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications</span>
                            <a href="#" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            {{-- Permissions --}}
                            {{-- @if($permissions->isNotEmpty())
                                <div class="text-overline m-b-5">Permissions</div>
                                <div class="card m-b-10">
                                    @foreach($permissions as $permission)
                                        <a href="{{ route('employeepermissions.index', ['p_id' => $permission->id]) }}"  class="d-block m-b-10">
                                            <div class="list-group list-group-flush ">
                                                <div class="list-group-item d-flex  align-items-center">
                                                    <div class="m-r-20">
                                                        <div class="avatar avatar-sm "><img src={{$permission->employee->photo}} class="avatar-img avatar-sm rounded-circle" alt=""></div>
                                                    </div>
                                                    <div class="" style="width:100%">
                                                        <div>{{ App\Helpers\AppHelper::pascalCaseString($permission->employee->user->name) }}</div>
                                                        <div class="text-muted"><span class="float-left">{{ str_limit($permission->reason, 20) }}</span><span class="float-right">{{$permission->date}}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <span class="avatar-title rounded-circle" style="background-color:#B57EDC;">
                                {{ Auth::user()->name[0] }}
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">
                        {{-- <a class="dropdown-item" href="{{ route('users.view-account') }}"> <i class="mdi mdi-eye"></i>&nbsp; View Account </a>
                        <a class="dropdown-item" href="{{ route('users.change-password') }}"> <i class="mdi mdi-key-variant"></i>&nbsp; Change Password</a>
                        <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-power"></i>&nbsp;{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#left-control').click(function () {
                if ($('.admin-sidebar').is(":visible")) {
                    $('.admin-sidebar').hide();
                    $('.admin-header').css('margin-left','0%');
                    $('.admin-main').css('margin-left','0%');
                    
                } else {
                    $('.admin-sidebar').show();
                    $('.admin-header').css('margin-left','10%');
                    $('.admin-main').css('margin-left','10%');
                }
            });

            $('.admin-close-sidebar').click(function () {
                $('.admin-sidebar').hide();
                $('.admin-header').css('margin-left','0%');
                $('.admin-main').css('margin-left','0%');
            })
        });
    </script>
    @endpush
</header>