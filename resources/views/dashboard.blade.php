@extends('layouts.dashboard')

@section('main')
<div class="container-fluid py-4">
    <!-- Shared Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="sakn-card border-0 shadow-sm rounded-4 p-4 bg-white d-flex align-items-center justify-content-between overflow-hidden position-relative">
                <div class="position-relative z-index-1">
                    <h2 class="fw-bold text-dark mb-1">Hello, {{ Auth::user()->name }}!</h2>
                    <p class="text-muted mb-0">Here's what's happening in <span class="text-gold fw-bold">Sakn</span> today.</p>
                </div>
                <div class="bg-gold-soft p-3 rounded-circle d-none d-md-block">
                    <i class="bi bi-stars fs-1 text-gold"></i>
                </div>
                <!-- Decorative element -->
                <div class="position-absolute end-0 top-0 h-100 w-25 bg-gold opacity-10" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
            </div>
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- 1. ADMIN SECTION (Operational Analytics & System) --}}
    {{-- ========================================================== --}}
    @role('admin')
    <div class="mb-5">
        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center">
            <span class="bg-green p-1 rounded-2 me-2" style="width: 10px; height: 25px; display: inline-block;"></span>
            Operational Intelligence
        </h5>
        
        <div class="row g-4 mb-4">
            <!-- Total Inventory -->
            <div class="col-md-6 col-lg-3">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-success h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success"><i class="bi bi-houses fs-4"></i></div>
                        <span class="text-success small fw-bold">+12%</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">1,248</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Total Inventory</p>
                </div>
            </div>

            <!-- Active Agents -->
            <div class="col-md-6 col-lg-3">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-primary h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary"><i class="bi bi-people fs-4"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">45</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Active Agents</p>
                </div>
            </div>

            <!-- Pending Approval -->
            <div class="col-md-6 col-lg-3">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-info h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info"><i class="bi bi-clipboard-check fs-4"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">15</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Pending Contracts</p>
                </div>
            </div>

            <!-- System Alerts -->
            <div class="col-md-6 col-lg-3">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-danger h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 p-2 rounded-3 text-danger"><i class="bi bi-exclamation-octagon fs-4"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">03</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Action Required</p>
                </div>
            </div>
        </div>

        <!-- Admin Charts Row -->
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="sakn-card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Market Growth Analysis</h5>
                            <p class="text-muted small mb-0">Visualizing property inventory performance</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle rounded-pill px-3 fw-bold" type="button" data-bs-toggle="dropdown">
                                This Year
                            </button>
                            <ul class="dropdown-menu border-0 shadow">
                                <li><a class="dropdown-item" href="#">Last Year</a></li>
                                <li><a class="dropdown-item" href="#">Current Month</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- ApexChart Container -->
                    <div id="growthChartApex" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- ========================================================== --}}
    {{-- 2. CONTENT MANAGER SECTION (Quality & Media Hub) --}}
    {{-- ========================================================== --}}
    @role('content manager')
    <div class="mb-5">
        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center">
            <span class="bg-gold p-1 rounded-2 me-2" style="width: 10px; height: 25px; display: inline-block;"></span>
            Content & Media Quality Hub
        </h5>
        
        <div class="row g-4 mb-4">
            <!-- Properties Missing Images -->
            <div class="col-md-6 col-lg-4">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-danger h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 p-2 rounded-3 text-danger"><i class="bi bi-images fs-4"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">12</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Missing Media</p>
                    <a href="#" class="text-danger small mt-2 d-inline-block text-decoration-none">Review Now &rarr;</a>
                </div>
            </div>

            <!-- AI Processing -->
            <div class="col-md-6 col-lg-4">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-warning h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning"><i class="bi bi-cpu fs-4"></i></div>
                        <div class="spinner-grow spinner-grow-sm text-warning" role="status"></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">24</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">AI Descriptions Enhancing</p>
                </div>
            </div>

            <!-- Documents Pending -->
            <div class="col-md-12 col-lg-4">
                <div class="sakn-card-stat border-0 shadow-sm rounded-4 p-4 bg-white border-bottom border-4 border-info h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info"><i class="bi bi-file-earmark-check fs-4"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">8</h3>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Docs Needs Verification</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="sakn-card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-bold text-dark mb-4">Content Quality Index</h5>
                    <div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 250px;">
                        <canvas id="qualityChart"></canvas>
                        <div class="position-absolute text-center">
                            <h2 class="fw-bold mb-0" style="color: var(--sakn-green);">94%</h2>
                            <small class="text-muted fw-bold">HEALTHY</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="sakn-card border-0 shadow-sm rounded-4 bg-white p-4 h-100 d-flex flex-column justify-content-center">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold">AI Processing Accuracy</span>
                            <span class="fw-bold text-success">98%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #f0f0f0;">
                            <div class="progress-bar" style="width: 98%; background: var(--sakn-gold-gradient);"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold">Data Completion</span>
                            <span class="fw-bold text-warning">72%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #f0f0f0;">
                            <div class="progress-bar bg-warning" style="width: 72%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted fw-bold">SEO Optimization</span>
                            <span class="fw-bold text-info">85%</span>
                        </div>
                        <div class="progress rounded-pill shadow-sm" style="height: 12px; background: #f0f0f0;">
                            <div class="progress-bar bg-info" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- ========================================================== --}}
    {{-- 2. SALE AGENT SECTION (Personal Sales Performance) --}}
    {{-- ========================================================== --}}
    @role('sale-agent')
    <div class="mb-5 mt-4">
        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center">
            <span class="bg-gold p-1 rounded-2 me-2" style="width: 10px; height: 25px; display: inline-block;"></span>
            Personal Performance Hub
        </h5>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="sakn-card border-0 shadow-sm rounded-4 bg-white p-4 text-center h-100 border-top border-4 border-gold">
                    <div class="bg-gold-soft rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 90px; height: 90px;">
                        <i class="bi bi-wallet2 text-gold fs-1"></i>
                    </div>
                    <p class="text-muted mb-1 fw-bold text-uppercase small" style="letter-spacing: 1px;">Earned Commission</p>
                    <h1 class="fw-bold text-dark mb-3">$14,250</h1>
                    <button class="sakn-btn-gold rounded-pill px-4 w-100 py-2 border-0">View Full History</button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="sakn-card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-dark mb-0">My Active Leads</h5>
                        <a href="#" class="text-gold small fw-bold text-decoration-none">View All Leads <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-0 mb-0">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th class="border-0 px-0">Lead Name</th>
                                    <th class="border-0">Property Interest</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 text-end">Probability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom border-light">
                                    <td class="border-0 px-0 fw-bold text-dark">Ahmed Mohammed</td>
                                    <td class="border-0 text-muted">Luxury Villa - Palm Jumeirah</td>
                                    <td class="border-0"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">HOT LEAD</span></td>
                                    <td class="border-0 text-end">
                                        <span class="fw-bold text-dark">92%</span>
                                    </td>
                                </tr>
                                <tr class="border-bottom border-light">
                                    <td class="border-0 px-0 fw-bold text-dark">Sara Al-Fahad</td>
                                    <td class="border-0 text-muted">Modern Apartment - Downtown</td>
                                    <td class="border-0"><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 fw-bold">FOLLOW UP</span></td>
                                    <td class="border-0 text-end">
                                        <span class="fw-bold text-dark">45%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- ========================================================== --}}
    {{-- 3. ADMIN SECTION (System Management) --}}
    {{-- ========================================================== --}}
    @role('admin')
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="sakn-card border-0 shadow-sm rounded-4 bg-dark p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 me-4 text-white">
                        <i class="bi bi-shield-lock-fill fs-3 text-gold"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-white mb-1">System Administration</h5>
                        <p class="text-white text-opacity-50 mb-0 small">Control user access, system configurations, and security audits.</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold small">Manage Users</a>
                    <a href="{{ route('roles.index') }}" class="sakn-btn-gold rounded-pill px-4 border-0 fw-bold small">Roles & Access Control</a>
                </div>
            </div>
        </div>
    </div>
    @endrole
</div>

<!-- ApexCharts for Premium Visualization -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @role('admin')
    if(document.querySelector("#growthChartApex")) {
        const growthOptions = {
            series: [{
                name: 'Inventory Growth',
                data: [40, 52, 45, 78, 65, 95, 88, 110, 105, 140, 135, 160]
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: { show: false },
                zoom: { enabled: false },
                fontFamily: 'Outfit, sans-serif'
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 4,
                colors: ['#BC9355']
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                    stops: [0, 90, 100],
                    colorStops: [
                        { offset: 0, color: "#BC9355", opacity: 0.4 },
                        { offset: 100, color: "#BC9355", opacity: 0 }
                    ]
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#94a3b8', fontWeight: 600 } }
            },
            yaxis: { show: false },
            grid: {
                show: true,
                borderColor: '#f1f1f1',
                strokeDashArray: 4,
                xaxis: { lines: { show: true } },
                yaxis: { lines: { show: false } }
            },
            markers: {
                size: 6,
                colors: ['#fff'],
                strokeColors: '#BC9355',
                strokeWidth: 3,
                hover: { size: 8 }
            },
            tooltip: {
                theme: 'dark',
                x: { show: true },
                marker: { show: false }
            }
        };

        const growthChart = new ApexCharts(document.querySelector("#growthChartApex"), growthOptions);
        growthChart.render();
    }
    @endrole

    @role('content manager')
    if(document.getElementById('qualityChart')) {
        // Quality Doughnut - Chart.js (Still okay for simple circles)
        const ctx2 = document.getElementById('qualityChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Excellent', 'Good', 'Action Required'],
                datasets: [{
                    data: [75, 20, 5],
                    backgroundColor: ['#2F4F3E', '#BC9355', '#dc3545'],
                    hoverOffset: 15,
                    borderWidth: 0
                }]
            },
            options: { 
                cutout: '85%', 
                plugins: { legend: { display: false } },
                animation: { animateScale: true, animateRotate: true }
            }
        });
    }
    @endrole
</script>

<style>
    .sakn-card-stat { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .sakn-card-stat:hover { transform: translateY(-7px); box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; }
    .bg-gold-soft { background: rgba(188, 147, 85, 0.08); }
    .dropdown-toggle::after { border-top-color: var(--sakn-gold); }
    .bg-green { background: var(--sakn-green); }
    .bg-gold { background: var(--sakn-gold); }
    .text-gold { color: var(--sakn-gold); }
    .btn-gold { background: var(--sakn-gold); color: #fff; }
    .btn-gold:hover { background: var(--sakn-green); color: #fff; }
</style>
@endsection
