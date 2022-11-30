@extends('Layouts.AdminMain')

@push('title')
    <title>Announcement</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-2">
        <h1 class="mb-1">Dashboard</h1>
        <div class="page-nav">
        </div>
    </div>
    <section class="section dashboard mt-2">

        <div class="row">

            <!-- accounts -->
            <div class="col-lg-3">
                <div class="card info-card accounts-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>
                            <li><a class="dropdown-item" onclick="show_accounts('all')">All</a></li>
                            <li><a class="dropdown-item" onclick="show_accounts('patient')">Patient</a></li>
                            <li><a class="dropdown-item" onclick="show_accounts('employee')">Employee</a></li>
                            <li><a class="dropdown-item" onclick="show_accounts('request')">Request</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <span class="card-title d-block ps-1 fw-normal info-card-title mt-3"> Accounts | <span id="accounts-total-selected">n</span> </span>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="fw-normal" id="accounts-total">n</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- medicine -->
            <div class="col-lg-3">
                <div class="card info-card medicine-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>
                            <li><a class="dropdown-item" onclick="show_medicine('all')">All</a></li>
                            <li><a class="dropdown-item" onclick="show_medicine('fordispensing')">For-dispensing</a></li>
                            <li><a class="dropdown-item" onclick="show_medicine('onhold')">On-hold</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <span class="card-title d-block ps-1 fw-normal info-card-title mt-3"> Medicine | <span id="medicine-total-selected">All</span> </span>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-capsule-pill"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="fw-normal" id="medicine-total">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- equipments -->
            <div class="col-lg-3">
                <div class="card info-card equipments-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>
                            <li><a class="dropdown-item" onclick="show_equipments('all')">All</a></li>
                            <li><a class="dropdown-item" onclick="show_equipments('working')">Working</a></li>
                            <li><a class="dropdown-item" onclick="show_equipments('not')">Not Working</a></li>
                            <li><a class="dropdown-item" onclick="show_equipments('returned')">Returned</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <span class="card-title d-block ps-1 fw-normal info-card-title mt-3"> Equipments | <span id="equipments-total-selected">n</span> </span>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="fw-normal" id="equipments-total">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- forms -->
            <div class="col-lg-3">
                <div class="card info-card forms-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>
                            <li><a class="dropdown-item" onclick="show_forms('ftd')">Today</a></li>
                            <li><a class="dropdown-item" onclick="show_forms('ftw')">This Week</a></li>
                            <li><a class="dropdown-item" onclick="show_forms('ftm')">This Month</a></li>
                            <li><a class="dropdown-item" onclick="show_forms('fty')">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <span class="card-title d-block ps-1 fw-normal info-card-title mt-3">Forms Created | <span id="form-total-selected">Today</span> </span>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="fw-normal" id="form-total">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- transaction -->
            <div class="col-lg-6">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>

                            <li><a class="dropdown-item" onclick="show_transaction('ttd')">Today</a></li>
                            <li><a class="dropdown-item" onclick="show_transaction('ttw')">This Week</a></li>
                            <li><a class="dropdown-item" onclick="show_transaction('ttm')">This Month</a></li>
                            <li><a class="dropdown-item" onclick="show_transaction('tty')">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-normal mt-3">Transaction Types | &nbsp;<span id="transaction-total-selected">Today</span></h5>
                        <div id="transaction-chart"></div>
                    </div>

                </div>
            </div>

            <!-- transaction frequency -->
            <div class="col-lg-6">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>
                            @foreach($transaction_freq as $tf)
                                <li><a class="dropdown-item" onclick="show_trans_freq('{{ $tf->year }}')">{{ $tf->year }}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-normal mt-3">Transaction frequency |&nbsp;<span id="trans-freq-selected">2022</span></h5>
                        <div id="transaction-frequency-chart"></div>
                    </div>

                </div>
            </div>
            
            <!-- dispense medicine -->
            <div class="col-lg-6">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-normal mt-3">Dispense Medicine | <span>&nbsp;Today</span></h5>
                        <div id="dispense-chart"></div>
                    </div>

                </div>
            </div>

             <!-- chief complain -->
             <div class="col-lg-6">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6 class="fw-normal">Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-normal mt-3">Chief Complaint | <span>&nbsp;Today</span></h5>
                        <div id="chief-complain-chart"></div>
                    </div>

                </div>
            </div>

            <!-- vaccination -->
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title fw-normal mt-3">Patient Vaccination</h5>
                        <div id="vaccination-chart"></div>
                    </div>

                </div>
            </div>

            
           
        </div>
    </section>
</main>

@endsection

@push('script')
    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>
        // transaction
        function bar_chart(data, categories, id, isHorizontal){
            var options = {
                series: [{
                    data: data
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: isHorizontal,
                    }
                },
                tooltip: {
                    enabled: false
                },
                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        rotate: 0
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector(id), options);
            chart.render();
        }

        // line
        function line_chart(name, data, categories, id){
            var options = {
                series: [{
                    name: name,
                    data: data
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                fill: {
                    type:'solid',
                    opacity: [0.35, 1],
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: categories,
                }
            };

            var chart = new ApexCharts(document.querySelector(id), options);
            chart.render();
        }

        // pie
        function pie_chart(data, categories, id){
            var options = {
                series: data,
                chart: {
                    height: 350,
                    type: 'pie',
                    toolbar: {
                        show: true
                    },
                },
                labels: categories,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector(id), options);
            chart.render();
        }

        function show_accounts(type){
            var patient = {{ number_format($accounts->patient) }}
            var employee = {{ number_format($accounts->employee) }}
            var request = {{ number_format($accounts->request) }}
            var all = {{ number_format($accounts->patient+$accounts->employee+$accounts->request) }}

            if(type=='patient'){
                $('#accounts-total-selected').html('Patient');
                $('#accounts-total').html(patient);
            }
            else if(type=='employee'){
                $('#accounts-total-selected').html('Employee');
                $('#accounts-total').html(employee);
            }
            else if(type=='request'){
                $('#accounts-total-selected').html('Request');
                $('#accounts-total').html(request);
            }
            else{
                $('#accounts-total-selected').html('All');
                $('#accounts-total').html(all);
            }
        }

        function show_medicine(type){
            var all = {{ number_format($medicines->onhold+$medicines->fordispensing) }}
            var onhold = {{ number_format($medicines->onhold) }}
            var fordispensing = {{ number_format($medicines->fordispensing) }}

            if(type=='onhold'){
                $('#medicine-total-selected').html('On-hold');
                $('#medicine-total').html(onhold);
            }
            else if(type=='fordispensing'){
                $('#medicine-total-selected').html('For-dispensing');
                $('#medicine-total').html(fordispensing);
            }
            else{
                $('#medicine-total-selected').html('All');
                $('#medicine-total').html(all);
            }
        }

        function show_equipments(type){
            var all = {{ number_format($equipments->working+$equipments->not) }}
            var working = {{ number_format($equipments->working) }}
            var not = {{ number_format($equipments->not) }}
            var returned = 0
            if(type=='all'){
                $('#equipments-total-selected').html('All');
                $('#equipments-total').html(all);
            }
            else if(type=='working'){
                $('#equipments-total-selected').html('Working');
                $('#equipments-total').html(working);
            }
            else if(type=='not'){
                $('#equipments-total-selected').html('Not Working');
                $('#equipments-total').html(not);
            }
            else{
                $('#equipments-total-selected').html('Returned');
                $('#equipments-total').html(returned);
            }
        }
        
        function show_forms(type){
            var ftd = {{ $forms->ftd }}
            var ftw = {{ $forms->ftw }}
            var ftm = {{ $forms->ftm }}
            var fty = {{ $forms->fty }}
            if(type=='ftd'){
                $('#form-total-selected').html('Today');
                $('#form-total').html(ftd);
            }
            else if(type=='ftw'){
                $('#form-total-selected').html('This Week');
                $('#form-total').html(ftw);
            }
            else if(type=='ftm'){
                $('#form-total-selected').html('This Month');
                $('#form-total').html(ftm);
            }
            else if(type=='fty'){
                $('#form-total-selected').html('This Year');
                $('#form-total').html(fty);
            }
        }

        // transaction
        function show_transaction(type){
            $('#transaction-chart').html('');            
            var data = [];
            if(type=='ttw'){
                $('#transaction-total-selected').html('This Week');
                data = ['{{ $ttw->b }}','{{ $ttw->c }}','{{ $ttw->mc }}','{{ $ttw->m }}','{{  $ttw->o  }}'];
            }
            else if(type=='ttd'){
                $('#transaction-total-selected').html('Today');
                data = ['{{ $ttd->b }}','{{ $ttd->c }}','{{ $ttd->mc }}','{{ $ttd->m }}','{{  $ttd->o  }}'];
            }
            else if(type=='ttm'){
                $('#transaction-total-selected').html('This Month');
                data = ['{{ $ttm->b }}','{{ $ttm->c }}','{{ $ttm->mc }}','{{ $ttm->m }}','{{  $ttm->o  }}'];
            }
            else if(type=='tty'){
                $('#transaction-total-selected').html('This Year');
                data = ['{{ $tty->b }}','{{ $tty->c }}','{{ $tty->mc }}','{{ $tty->m }}','{{  $tty->o  }}'];
            }

            bar_chart(
                data, 
                ['BP', 'Consultation', ['Medical', 'Certificate'], 'Medicine', 'Others'],
                '#transaction-chart',
                false
            );
        }

        // transaction frequency
        function show_trans_freq(year){
            $('#transaction-frequency-chart').html('');
            var data = [];
            @foreach($transaction_freq as $tf)
                if(year=={{ $tf->year }}){
                    $('#trans-freq-selected').html(year);
                    data = ['{{ $tf->jan }}','{{ $tf->feb }}','{{ $tf->mar }}','{{ $tf->apr }}','{{ $tf->may }}','{{ $tf->jun }}','{{ $tf->jul }}','{{ $tf->aug }}','{{ $tf->sep }}','{{ $tf->oct }}','{{ $tf->nov }}','{{ $tf->dec }}']
                }
            @endforeach

            line_chart(
                'Total',
                data, 
                ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                '#transaction-frequency-chart'
            );
        }

        // dispense
        function show_dispense(type){
            $('#dispense-chart').html('');
            if(type=="today"){
                data = [{{ $dftda[0]['qty'] }},{{ $dftda[1]['qty'] }},{{ $dftda[2]['qty'] }},{{ $dftda[3]['qty'] }},{{ $dftda[4]['qty'] }}];
                categories = ["{{ $dftda[0]['gn'] }}","{{ $dftda[1]['gn'] }}","{{ $dftda[2]['gn'] }}","{{ $dftda[3]['gn'] }}","{{ $dftda[4]['gn'] }}"]
            }
            else if(type=="tw"){
                data = [];
                categories = [];
            }
            else if(type=="tm"){

            }
            else if(type=="ty"){

            }
            else{

            }
            bar_chart(
                data, 
                categories,
                '#dispense-chart',
                false
            );
        }
        show_accounts('all');
        show_medicine('all');
        show_equipments('all');
        show_forms('ftd');
        show_transaction('ttd');
        show_trans_freq({{ date('Y') }});
        show_dispense('today');
        
        
        // chief complain
        bar_chart(
            [20, 50, 15, 30, 20], 
            ['1', '2', '3', '4', '5'],
            '#chief-complain-chart',
            true
        );
        // vaccination
        pie_chart(
            [{{ $vaxx->unvaxx }},{{ $vaxx->par_vaxx }},{{ $vaxx->fully_vaxx }},{{ $vaxx->boosted }}],
            ['Unvaccinated', 'Partially Vaccinated','Vaccinated', 'Boosted'],
            '#vaccination-chart'
        );
    </script>
@endpush