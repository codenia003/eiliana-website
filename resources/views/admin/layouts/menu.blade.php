



 <li {!! ( Request::is('admin/technologies*') || Request::is('admin/designations*') || Request::is('admin/educationTypes*') || Request::is('admin/employerTypes*') || Request::is('admin/projectCategories*') || Request::is('admin/projectStatuses*') || Request::is('admin/qualifications*') || Request::is('admin/universities*') || Request::is('admin/currencies*') || Request::is('admin/languages*') || Request::is('admin/locations*') || Request::is('admin/candidateRoles*') ? 'class="active"' : '' ) !!}>
        <a href="#">
            <i class="livicon" data-name="wrench" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
            <span class="title">Master</span>
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


<li>
    <a href="#">
            <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
            <span class="title">Reports</span>
            <span class="fa arrow"></span>
        </a>
        <ul>
            
        </ul>
</li>

<li {!! (Request::is('admin/finance*') || Request::is('admin/job_finance*') || Request::is('admin/resourceDetails*') ? 'class="active"' : '' ) !!}>
    <a href="#">
        <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
        <span class="title">Billing & Payment</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/finance*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.finances.index') }}">
                <i class="fa fa-angle-double-right"></i>
                  Project Billing & Payment
            </a>
        </li>
         <li {!! (Request::is('admin/job_finance*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.job_finance.index') }}">
                <i class="fa fa-angle-double-right"></i>
                  Job Billing & Payment
            </a>
        </li>
        <li {!! (Request::is('admin/resourceDetails*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.resourceDetails.index') }}">
                <i class="fa fa-angle-double-right"></i>
                Resource Details List
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/homePage*') ? 'class="active"' : '' ) !!}>
    <a href="#">
        <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
        <span class="title">Home</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/homePage*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.homePage.index') }}">
                <i class="fa fa-angle-double-right"></i>
                Home Page Details List
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/directOrders*') ? 'class="active"' : '' ) !!}>
    <a href="#">
        <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
        <span class="title">Direct Orders</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/directOrders_job*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.directOrders.job.index') }}">
                <i class="fa fa-angle-double-right"></i>
                 Contract Staffing
            </a>
        </li>
        <li {!! (Request::is('admin/directOrders_project*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.directOrders.project.index') }}">
                <i class="fa fa-angle-double-right"></i>
                 Project
            </a>
        </li>
    </ul>
</li>

<li {!! (Request::is('admin/salesReferral*') ? 'class="active"' : '' ) !!}>
    <a href="#">
        <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#67C5DF" data-hc="#67C5DF" data-loop="true"></i>
        <span class="title">Eiliana Sales Referral</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/salesReferral_job*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.salesReferral.job.index') }}">
                <i class="fa fa-angle-double-right"></i>
                 Contract Staffing
            </a>
        </li>
        <li {!! (Request::is('admin/salesReferral_project*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.salesReferral.project.index') }}">
                <i class="fa fa-angle-double-right"></i>
                 Project
            </a>
        </li>
        <li {!! (Request::is('admin/salesReferral_list*') ? 'class="active"' : '' ) !!}>
            <a href="{{ route('admin.salesReferral.index') }}">
                <i class="fa fa-angle-double-right"></i>
                New Sales Referral Leads
            </a>
        </li>
    </ul>
</li>

