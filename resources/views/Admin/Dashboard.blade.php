<x-admin.layout tabTitle="Dashboard" pageTitle="Welcome Back! <strong>Muhammad Salam 👋</strong>" breadcrumb="Home ➔ Dashboard">

    <div class="d-flex flex-wrap gap-3 mt-3">
        <div class="d-flex dashboard-stats-card gap-md-3 gap-2 mt-md-3 mt-2">
            <div class="dashboard-icon-card dark-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-user-multiple-4 position-absolute"></i>
                <h5>Total Users</h5>
                <h3>25</h3>
            </div>
            <div class="dashboard-icon-card blue-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-box-closed position-absolute"></i>
                <h5>Total Customers</h5>
                <h3>1298</h3>
            </div>
            <div class="dashboard-icon-card orange-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-box-closed position-absolute"></i>
                <h5>Total Orders</h5>
                <h3>2573</h3>
            </div>
            <div class="dashboard-icon-card yellow-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-box-closed position-absolute"></i>
                <h5>In Processing Orders</h5>
                <h3>2573</h3>
            </div>
            <div class="dashboard-icon-card red-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-box-closed position-absolute"></i>
                <h5>Total Reurns</h5>
                <h3>2573</h3>
            </div>

            <div class="dashboard-icon-card purple-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-label-dollar-2 position-absolute"></i>
                <h5>Total Sales</h5>
                <h3>$78200</h3>
            </div>
            <div class="dashboard-icon-card green-gradiant p-3 mb-1 position-relative">
                <i class="lni lni-bar-chart-dollar position-absolute"></i>
                <h5>Total Profit</h5>
                <h3>$31200</h3>
            </div>
        </div>
        <div class="dashboard-icon-card w-auto p-3 mb-1 position-relative">
            <h5 class="text-dark">Total Orders</h5>
            <p class="text-muted w-75">General analytics are displaying a comparative analysis against
                yesterday’s data.</p>
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="mb-1">
                    <h6 class="text-black fw-500">Website Visitors</h6>
                    <h6 class="text-success d-flex align-items-center"><i class="lni lni-arrow-upward fs-16"></i>1058
                    </h6>
                </div>
                <div class="mb-1">
                    <h6 class="text-black fw-500">Products Views</h6>
                    <h6 class="text-danger d-flex align-items-center"><i class="lni lni-arrow-downward fs-16"></i>1058
                    </h6>
                </div>
                <div class="mb-1">
                    <h6 class="text-black fw-500">Purchase Interest</h6>
                    <h6 class="text-success d-flex align-items-center"><i class="lni lni-arrow-upward fs-16"></i> 78%
                    </h6>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>