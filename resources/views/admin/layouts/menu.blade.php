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
    </ul>
</li>


