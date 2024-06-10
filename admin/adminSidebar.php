<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="adminPanel.php" class="text-nowrap mt-3">
                <img src="../assets/img/logo-text-black.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav p-2" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="adminPanel.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <span class="hide-menu">Product Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="addProducts.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-folder-plus"></i>
                        </span>
                        <span class="hide-menu">Add Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="manageProducts.php" aria-expanded="false">
                        <span>
                            <i class="fa-brands fa-product-hunt"></i>
                        </span>
                        <span class="hide-menu">Products Status</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="addStock.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-ranking-star"></i>
                        </span>
                        <span class="hide-menu">Add Stock</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">User Management</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="manageUsers.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-users-gear"></i>
                        </span>
                        <span class="hide-menu">View Users</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Reports</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="adminReportSales.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                        </span>
                        <span class="hide-menu">Sales Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="adminReportProducts.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </span>
                        <span class="hide-menu">Products Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="adminReportUsers.php" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-address-card"></i>
                        </span>
                        <span class="hide-menu">User Report</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Actions</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link active bg-warning" href="../index.php" target="_blank" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-up-right-from-square"></i>
                        </span>
                        <span class="hide-menu">Live View</span>
                    </a>
                </li>
                <li class="sidebar-item mt-2">
                    <a class="sidebar-link active bg-danger" href="#" onclick="adminSignout();" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-door-open"></i>
                        </span>
                        <span class="hide-menu">Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>