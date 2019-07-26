@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('quickadmin.user-actions.title')</span>
                        </a>
                    </li>@endcan

                   
                    
                </ul>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone-square"></i>
                    <span>@lang('Front End')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
               
                    <li>
                        <a href="{{ route('admin.contacts.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('contact')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.titles.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('title')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.commentstudents.index') }}">
                            <i class="fa fa-address-book-o"></i>
                            <span>@lang('commentstudent')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}">
                            <i class="fa fa-500px"></i>
                            <span>@lang('news')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tags.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('tags')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.titlefooters.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('titlefooter')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('service')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.registers.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('register')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.qoutes.index') }}">
                            <i class="fa fa-500px"></i>
                            <span>@lang('qoute')</span>
                        </a>
                    </li>
                    
                </ul>
            </li>@endcan
            
            @can('course_access')
            <li>
                <a href="{{ route('admin.courses.index') }}">
                    <i class="fa fa-outdent"></i>
                    <span>@lang('quickadmin.courses.title')</span>
                </a>
            </li>@endcan
            
            @can('lesson_access')
            <li>
                <a href="{{ route('admin.lessons.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.lessons.title')</span>
                </a>
            </li>@endcan
            
            @can('question_access')
            <li>
                <a href="{{ route('admin.questions.index') }}">
                    <i class="fa fa-question"></i>
                    <span>@lang('quickadmin.question.title')</span>
                </a>
            </li>@endcan
            
            @can('question_option_access')
            <li>
                <a href="{{ route('admin.question_options.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.question-option.title')</span>
                </a>
            </li>@endcan
            
            @can('test_access')
            <li>
                <a href="{{ route('admin.tests.index') }}">
                    <i class="fa fa-cogs"></i>
                    <span>@lang('quickadmin.test.title')</span>
                </a>
            </li>@endcan

          
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="{{ route('auth.logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </li>
        </ul>
    </section>
</aside>

