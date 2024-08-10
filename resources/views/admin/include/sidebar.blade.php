<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a class="" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Orders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">Completed Orders</a></li>
                    <li><a href="#">Canceled Orders</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Products</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('product.index') }}">All Products</a></li>
                    <li><a href="{{ route('product.create') }}">Add Products</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-menu menu-icon"></i><span class="nav-text">Categories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('category.index') }}">Category</a></li>
                    <li><a href="{{ route('subcategory.index') }}">Sub Category</a></li>
                    <li><a href="{{ route('brand.index') }}">Brands</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-user menu-icon"></i><span class="nav-text">Employee</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('employee.index') }}">All Employee</a></li>
                    <li><a href="{{ route('employeePosition.index') }}">Employee Positions</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-money menu-icon"></i><span class="nav-text">Wallet Report</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">All Reports</a></li>
                    <li><a href="#">Add Other Expenses</a></li>
                    <li><a href="{{ route('payment.index') }}">Payment Methods</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Employee Attandence</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">Monthly Attandence</a></li>
                    <li><a href="#">Leave Type</a></li>
                    <li><a href="#">Employee Attandence Report</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
