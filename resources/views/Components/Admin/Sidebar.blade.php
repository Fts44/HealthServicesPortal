<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">

        <li class="nav-item">
            <a class="nav-link collapsed" href="" id="sidebar_message">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" id="sidebar_inventory"  data-bs-target="#inventory-nav" data-bs-toggle="collapse" >
                <i class="bi bi-box-seam"></i>
                <span>Inventory</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="inventory-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Medicines</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Equipments</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" id="sidebar_accounts"  data-bs-target="#accounts-nav" data-bs-toggle="collapse" >
                <i class="bi bi-people"></i>
                <span>Accounts</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="accounts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Employees</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('AdminAccountsPatients') }}">
                        <i class="bi bi-circle"></i><span>Patients</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="bi bi-circle"></i><span>Requests</span>
                    </a>
                </li>
            </ul>
        </li>

    </li>

    <li class="nav-item">
            <a class="nav-link collapsed" href="#" id="sidebar_configuration"  data-bs-target="#configuration-nav" data-bs-toggle="collapse" >
                <i class="bi bi-gear"></i>
                <span>Configuration</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="configuration-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Medicines</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Equipments</span>
                    </a>
                </li>
            </ul>
        </li>

</ul>

</aside>