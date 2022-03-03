<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="images/logo.png" height="34">
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Sign out</a>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-flex sidebar collapse scrollbar">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap" />
                        </svg>
                        <span class="fs-4">Sidebar</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <button class="btn sidebar-btn align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2" />
                                </svg>
                                Dashboard
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="btn sidebar-btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#helpdesk-collapse" aria-expanded="false">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#person-workspace" />
                                </svg>
                                Help Desk
                            </button>
                            <div class="collapse" id="helpdesk-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="#" class="link-dark rounded"> Open Tickets</a></li>
                                    <li><a href="#" class="link-dark rounded"> Your Tickets</a></li>
                                    <li><a href="#" class="link-dark rounded"> Search</a></li>
                                    <li><a href="#" class="link-dark rounded"> Reports</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="btn sidebar-btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#inventory-collapse" aria-expanded="false">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#table" />
                                </svg>
                                Inventory
                            </button>
                            <div class="collapse" id="inventory-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="#" class="link-dark rounded"> Search</a></li>
                                    <li><a href="#" class="link-dark rounded"> Add Device</a></li>
                                    <li><a href="#" class="link-dark rounded"> Add User</a></li>
                                    <li><a href="#" class="link-dark rounded"> Reports</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="btn sidebar-btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#timesheet-collapse" aria-expanded="false">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#clock" />
                                </svg>
                                Timesheet
                            </button>
                            <div class="collapse" id="timesheet-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="#" class="link-dark rounded"> Check In</a></li>
                                    <li><a href="#" class="link-dark rounded"> Check Out</a></li>
                                    <li><a href="#" class="link-dark rounded"> View Map</a></li>
                                    <li><a href="#" class="link-dark rounded"> Reports</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="btn sidebar-btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#software-collapse" aria-expanded="false">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#grid" />
                                </svg>
                                Apps
                            </button>
                            <div class="collapse" id="software-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="#" class="link-dark rounded"> Check In</a></li>
                                    <li><a href="#" class="link-dark rounded"> Check Out</a></li>
                                    <li><a href="#" class="link-dark rounded"> View Map</a></li>
                                    <li><a href="#" class="link-dark rounded"> Reports</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="btn sidebar-btn align-items-center rounded collapsed">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#gear" />
                                </svg>
                                Settings
                            </button>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://helpdesk.lkgeorge.org/photos/Teachers/50910.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>mdo</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>