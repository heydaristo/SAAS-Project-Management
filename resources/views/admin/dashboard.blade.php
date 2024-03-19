@extends('admintemplate')

@section('adminbody')
    <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Sales</div>
                        <div class="ms-auto lh-1">
                            <select class="form-select" id="sales-chart" onchange="myFunction4()">
                                <option value="3months">Last 3 Months</option>
                                <option value="30days">Last 30 days</option>
                                <option value="7days">Last 7 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="h1 mb-3" id="conversionrate-number">{{ round($conversionRate3Months) }}%</div>
                    <div class="d-flex mb-2">
                        <div>Conversion rate</div>
                        <div class="ms-auto">
                            <span class="text-green d-inline-flex align-items-center lh-1">
                                8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 17l6 -6l4 4l8 -8" />
                                    <path d="M14 7l7 0l0 7" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" id="progress-bar-sales"
                            style="width: {{ $conversionRate3Months }}%" role="progressbar" aria-valuenow="10"
                            aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                            {{-- <span class="visually-hidden">{{$conversionRate3Months}}% Complete</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Revenue</div>
                        <div class="ms-auto lh-1">
                            <select class="form-select" id="revenue-chart" onchange="myFunction()">
                                <option value="3months">Last 3 Months</option>
                                <option value="30days">Last 30 days</option>
                                <option value="7days">Last 7 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline" id="chart-rev-sum">
                        <div class="h1 mb-3 me-2">@currency($revenueSummaryThreeMonths)</div>
                    </div>
                    <div class="rounded" id="chart-position">
                        <div class="" id="3monthschart">
                            {!! $revenueChartThreeMonths->container() !!}
                        </div>
                        <div class="d-none" id="30dayschart">
                            {!! $revenueChartThirtyDays->container() !!}
                        </div>
                        <div class="d-none" id="7dayschart">
                            {!! $revenueChartSevenDays->container() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Frelance</div>
                        <div class="ms-auto lh-1">
                            <select class="form-select" id="freelance-chart" onchange="myFunction2()">
                                <option value="3months">Last 3 Months</option>
                                <option value="30days">Last 30 days</option>
                                <option value="7days">Last 7 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline" id="chart-freelance-sum">
                        <div class="h1 mb-3 me-2">{{ $freelanceSummaryThreeMonths }}</div>
                    </div>
                    <div class="rounded" id="freelance-chart-position">
                        <div class="" id="3monthschart-freelance">
                            {!! $freelanceChartThreeMonths->container() !!}
                        </div>
                        <div class="d-none" id="30dayschart-freelance">
                            {!! $freelanceChartThirtyDays->container() !!}
                        </div>
                        <div class="d-none" id="7dayschart-freelance">
                            {!! $freelanceChartSevenDays->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Active User</div>
                        <div class="ms-auto lh-1">
                            <select class="form-select" id="activeuser-chart" onchange="myFunction3()">
                                <option value="3months">Last 3 Months</option>
                                <option value="30days">Last 30 days</option>
                                <option value="7days">Last 7 days</option>
                                <option value="15minutes">Last 15 minutes</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline" id="chart-activeuser-sum">
                        <div class="h1 mb-3 me-2">{{ $useractive15minutes }}</div>
                    </div>
                    <div class="rounded" id="activeuser-chart-position">
                        <div class="d-none" id="3monthschart-activeuser">
                            {!! $activeUserChartThreeMonths->container() !!}
                        </div>
                        <div class="d-none" id="30dayschart-activeuser">
                            {!! $activeUserChartThirtyDays->container() !!}
                        </div>
                        <div class="d-none" id="7dayschart-activeuser">
                            {!! $activeUserChartSevenDays->container() !!}
                        </div>
                        <div class="" id="15minuteschart-activeuser">
                            {!! $activeUserChartFifteenMinutes->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function myFunction() {
            var id = 1;
            $.ajax({
                url: "{{ route('admin.transaction.listsubscriptions', ['id' => '+id+']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var x = document.getElementById("revenue-chart").value;
                    if (x == '3months') {
                        var z = document.getElementById("chart-rev-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">@currency($revenueSummaryThreeMonths)</div>';
                        // hide chart 30 days and 7 days
                        document.getElementById("3monthschart").classList.remove('d-none');
                        document.getElementById("30dayschart").classList.add('d-none');
                        document.getElementById("7dayschart").classList.add('d-none');

                    }
                    if (x == '30days') {
                        var z = document.getElementById("chart-rev-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">@currency($revenueSummaryThirtyDays)</div>';
                        // hide chart 3 months and 7 days
                        document.getElementById("30dayschart").classList.remove('d-none');
                        document.getElementById("3monthschart").classList.add('d-none');
                        document.getElementById("7dayschart").classList.add('d-none');
                    }
                    if (x == '7days') {
                        var z = document.getElementById("chart-rev-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">@currency($revenueSummarySevenDays)</div>';
                        // hide chart 3 months and 30 days
                        document.getElementById("7dayschart").classList.remove('d-none');
                        document.getElementById("3monthschart").classList.add('d-none');
                        document.getElementById("30dayschart").classList.add('d-none');
                    }
                }
            });

        }
    </script>

    <script src="{{ $revenueChartThreeMonths->cdn() }}"></script>
    {{ $revenueChartThreeMonths->script() }}

    <script src="{{ $revenueChartThirtyDays->cdn() }}"></script>
    {{ $revenueChartThirtyDays->script() }}

    <script src="{{ $revenueChartSevenDays->cdn() }}"></script>
    {{ $revenueChartSevenDays->script() }}

    <script>
        function myFunction2() {
            var id = 1;
            $.ajax({
                url: "{{ route('admin.transaction.listsubscriptions', ['id' => '+id+']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var x = document.getElementById("freelance-chart").value;
                    if (x == '3months') {
                        var z = document.getElementById("chart-freelance-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $freelanceSummaryThreeMonths }}</div>';
                        // hide chart 30 days and 7 days
                        document.getElementById("3monthschart-freelance").classList.remove('d-none');
                        document.getElementById("30dayschart-freelance").classList.add('d-none');
                        document.getElementById("7dayschart-freelance").classList.add('d-none');

                    }
                    if (x == '30days') {
                        var z = document.getElementById("chart-freelance-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $freelanceSummaryThirtyDays }}</div>';
                        // hide chart 3 months and 7 days
                        document.getElementById("30dayschart-freelance").classList.remove('d-none');
                        document.getElementById("3monthschart-freelance").classList.add('d-none');
                        document.getElementById("7dayschart-freelance").classList.add('d-none');
                    }
                    if (x == '7days') {
                        var z = document.getElementById("chart-freelance-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $freelanceSummarySevenDays }}</div>';
                        // hide chart 3 months and 30 days
                        document.getElementById("7dayschart-freelance").classList.remove('d-none');
                        document.getElementById("3monthschart-freelance").classList.add('d-none');
                        document.getElementById("30dayschart-freelance").classList.add('d-none');
                    }
                }
            });

        }
    </script>

    <script src="{{ $freelanceChartThreeMonths->cdn() }}"></script>
    {{ $freelanceChartThreeMonths->script() }}
    <script src="{{ $freelanceChartThirtyDays->cdn() }}"></script>
    {{ $freelanceChartThirtyDays->script() }}
    <script src="{{ $freelanceChartSevenDays->cdn() }}"></script>
    {{ $freelanceChartSevenDays->script() }}

    <script>
        function myFunction3() {
            var id = 1;
            $.ajax({
                url: "{{ route('admin.transaction.listsubscriptions', ['id' => '+id+']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var x = document.getElementById("activeuser-chart").value;
                    if (x == '3months') {
                        var z = document.getElementById("chart-activeuser-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $useractive3months }}</div>';
                        // hide chart 30 days and 7 days
                        document.getElementById("3monthschart-activeuser").classList.remove('d-none');
                        document.getElementById("30dayschart-activeuser").classList.add('d-none');
                        document.getElementById("7dayschart-activeuser").classList.add('d-none');
                        document.getElementById("15minuteschart-activeuser").classList.add('d-none');

                    }
                    if (x == '30days') {
                        var z = document.getElementById("chart-activeuser-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $useractive30days }}</div>';
                        // hide chart 3 months and 7 days
                        document.getElementById("30dayschart-activeuser").classList.remove('d-none');
                        document.getElementById("3monthschart-activeuser").classList.add('d-none');
                        document.getElementById("7dayschart-activeuser").classList.add('d-none');
                        document.getElementById("15minuteschart-activeuser").classList.add('d-none');
                    }
                    if (x == '7days') {
                        var z = document.getElementById("chart-activeuser-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $useractive7days }}</div>';
                        // hide chart 3 months and 30 days
                        document.getElementById("7dayschart-activeuser").classList.remove('d-none');
                        document.getElementById("3monthschart-activeuser").classList.add('d-none');
                        document.getElementById("30dayschart-activeuser").classList.add('d-none');
                        document.getElementById("15minuteschart-activeuser").classList.add('d-none');
                    }
                    if (x == '15minutes') {
                        var z = document.getElementById("chart-activeuser-sum");
                        z.innerHTML = '<div class="h1 mb-3 me-2">{{ $useractive15minutes }}</div>';
                        // hide chart 3 months and 30 days
                        document.getElementById("15minuteschart-activeuser").classList.remove('d-none');
                        document.getElementById("3monthschart-activeuser").classList.add('d-none');
                        document.getElementById("30dayschart-activeuser").classList.add('d-none');
                        document.getElementById("7dayschart-activeuser").classList.add('d-none');
                    }
                }
            });

        }
    </script>

    <script src="{{ $activeUserChartThreeMonths->cdn() }}"></script>
    {{ $activeUserChartThreeMonths->script() }}
    <script src="{{ $activeUserChartThirtyDays->cdn() }}"></script>
    {{ $activeUserChartThirtyDays->script() }}
    <script src="{{ $activeUserChartSevenDays->cdn() }}"></script>
    {{ $activeUserChartSevenDays->script() }}
    <script src="{{ $activeUserChartFifteenMinutes->cdn() }}"></script>
    {{ $activeUserChartFifteenMinutes->script() }}

    <script>
        function myFunction4() {
            var id = 1;
            $.ajax({
                url: "{{ route('admin.transaction.listsubscriptions', ['id' => '+id+']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    var x = document.getElementById("sales-chart").value;
                    if (x == '3months') {
                        var z = document.getElementById("conversionrate-number");
                        z.innerHTML = '{{ round($conversionRate3Months) }}%';
                        // hide chart 30 days and 7 days
                        document.getElementById("progress-bar-sales").style.width =
                            '{{ round($conversionRate3Months) }}%';
                    }
                    if (x == '30days') {
                        var z = document.getElementById("conversionrate-number");
                        z.innerHTML = '{{ round($conversionRate30Days) }}%';
                        // hide chart 3 months and 7 days
                        document.getElementById("progress-bar-sales").style.width =
                            '{{ round($conversionRate30Days) }}%';
                    }
                    if (x == '7days') {
                        var z = document.getElementById("conversionrate-number");
                        z.innerHTML = '{{ round($conversionRate7Days) }}%';
                        // hide chart 3 months and 30 days
                        document.getElementById("progress-bar-sales").style.width =
                            '{{ round($conversionRate7Days) }}%';
                    }
                }
            });

        }
    </script>
@endsection
