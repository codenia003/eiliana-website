



 <li {!! ( Request::is('admin/technologies*') || Request::is('admin/designations*') || Request::is('admin/educationTypes*') || Request::is('admin/employerTypes*') || Request::is('admin/projectCategories*') || Request::is('admin/projectStatuses*') || Request::is('admin/qualifications*') || Request::is('admin/universities*') || Request::is('admin/currencies*') || Request::is('admin/languages*') || Request::is('admin/locations*') || Request::is('admin/candidateRoles*') ? 'class="active"' : '' ) !!}>
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
            <li {!! (Request::is('admin/universities*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.universities.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Universities
                </a>
            </li>
            <li {!! (Request::is('admin/currencies*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.currencies.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Currencies
                </a>
            </li>
             <li {!! (Request::is('admin/languages*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.languages.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Languages
                </a>
            </li>
            <li {!! (Request::is('admin/locations*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.locations.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Locations
                </a>
            </li>
             <li {!! (Request::is('admin/candidateRoles*') ? 'class="active"' : '' ) !!}>
                <a href="{{ route('admin.candidateRoles.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Candidate Roles
                </a>
            </li>

        </ul>
    </li>


<!-- <li class="{{ Request::is('admin/candidateRoles*') ? 'active' : '' }}">
    <a href="{!! route('admin.candidateRoles.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               CandidateRoles
    </a>
</li> -->

