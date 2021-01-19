



 <li {!! ( Request::is('admin/technologies*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="wrench" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Settings</span>
            <span class="fa arrow"></span>
        </a>

        <ul class="sub-menu">
            <li {!! (Request::is('admin/technologies*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.technologies.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Technologies
                </a>
            </li>
            <li {!! (Request::is('admin/designations*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.designations.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Designations
                </a>
            </li>
            <li {!! (Request::is('admin/educationTypes*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.educationTypes.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Education Types
                </a>
            </li>
             <li {!! (Request::is('admin/employerTypes*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.employerTypes.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Employer Types
                </a>
            </li>
             <li {!! (Request::is('admin/projectCategories*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.projectCategories.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Project Categories
                </a>
            </li>
            <li {!! (Request::is('admin/projectStatuses*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.projectStatuses.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Project Status
                </a>
            </li>
             <li {!! (Request::is('admin/qualifications*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.qualifications.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Qualifications
                </a>
            </li>

        </ul>
    </li>
   


<!-- 
<li class="{{ Request::is('admin/qualifications*') ? 'active' : '' }}">
    <a href="{!! route('admin.qualifications.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               Qualifications
    </a>
</li> -->

