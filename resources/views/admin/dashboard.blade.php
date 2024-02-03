@extends('admintemplate')

@section('adminbody')

<div class="row row-deck row-cards">
  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Sales</div>
          <div class="ms-auto lh-1">
            <select class="form-select">
              <option value="3months">Last 3 Months</option>
              <option value="30days">Last 30 days</option>
              <option value="7days">Last 7 days</option>
            </select>
          </div>
        </div>
        <div class="h1 mb-3">75%</div>
        <div class="d-flex mb-2">
          <div>Conversion rate</div>
          <div class="ms-auto">
            <span class="text-green d-inline-flex align-items-center lh-1">
              7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
            </span>
          </div>
        </div>
        <div class="progress progress-sm">
          <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
            <span class="visually-hidden">75% Complete</span>
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
          <div class="subheader">New Freelance</div>
          <div class="ms-auto lh-1">
            <div class="dropdown">
              <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item active" href="#">Last 7 days</a>
                <a class="dropdown-item" href="#">Last 30 days</a>
                <a class="dropdown-item" href="#">Last 3 months</a>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-3 me-2">6,782</div>
          <div class="me-auto">
            <span class="text-yellow d-inline-flex align-items-center lh-1">
              0% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
            </span>
          </div>
        </div>
        <div id="chart-new-clients" class="chart-sm"></div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Active users</div>
          <div class="ms-auto lh-1">
            <div class="dropdown">
              <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item active" href="#">Last 7 days</a>
                <a class="dropdown-item" href="#">Last 30 days</a>
                <a class="dropdown-item" href="#">Last 3 months</a>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-baseline">
          <div class="h1 mb-3 me-2">2,986</div>
          <div class="me-auto">
            <span class="text-green d-inline-flex align-items-center lh-1">
              4% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
            </span>
          </div>
        </div>
        <div id="chart-active-users" class="chart-sm"></div>
      </div>
    </div>
  </div>
  
   
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Traffic summary</h3>
          <div id="chart-mentions" class="chart-lg"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="card-title">Client List</div>
        </div>
        <div class="card-table table-responsive">
          <table class="table table-vcenter">
            <thead>
              <tr>
                <th></th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="w-1">
                  <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                </td>
                <td class="td-truncate">
                  <div class="text-truncate">
                    Fix dart Sass compatibility (#29755)
                  </div>
                </td>
                <td class="text-nowrap text-muted">28 Nov 2019</td>
                <td>Active</td>
              </tr>
              <tr>
                <td class="w-1">
                  <span class="avatar avatar-sm">JL</span>
                </td>
                <td class="td-truncate">
                  <div class="text-truncate">
                    Change deprecated html tags to text decoration classes (#29604)
                  </div>
                </td>
                <td class="text-nowrap text-muted">27 Nov 2019</td>
                <td>Active</td>
              </tr>
              <tr>
                <td class="w-1">
                  <span class="avatar avatar-sm" style="background-image: url(./static/avatars/002m.jpg)"></span>
                </td>
                <td class="td-truncate">
                  <div class="text-truncate">
                    justify-content:between ⇒ justify-content:space-between (#29734)
                  </div>
                </td>
                <td class="text-nowrap text-muted">26 Nov 2019</td>
              </tr>
              <tr>
                <td class="w-1">
                  <span class="avatar avatar-sm" style="background-image: url(./static/avatars/003m.jpg)"></span>
                </td>
                <td class="td-truncate">
                  <div class="text-truncate">
                    Update change-version.js (#29736)
                  </div>
                </td>
                <td class="text-nowrap text-muted">26 Nov 2019</td>
              </tr>
              <tr>
                <td class="w-1">
                  <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000f.jpg)"></span>
                </td>
                <td class="td-truncate">
                  <div class="text-truncate">
                    Regenerate package-lock.json (#29730)
                  </div>
                </td>
                <td class="text-nowrap text-muted">25 Nov 2019</td>
                <td>Active</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Invoices</h3>
        </div>
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            <div class="text-muted">
              Show
              <div class="mx-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
              </div>
              entries
            </div>
            <div class="ms-auto text-muted">
              Search:
              <div class="ms-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>
                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                </th>
                <th>Invoice Subject</th>
                <th>Client</th>
                <th>VAT No.</th>
                <th>Created</th>
                <th>Status</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001401</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                <td>
                  <span class="flag flag-country-us"></span>
                  Carlson Limited
                </td>
                <td>
                  87956621
                </td>
                <td>
                  15 Dec 2017
                </td>
                <td>
                  <span class="badge bg-success me-1"></span> Paid
                </td>
                <td>$887</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001402</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                <td>
                  <span class="flag flag-country-gb"></span>
                  Adobe
                </td>
                <td>
                  87956421
                </td>
                <td>
                  12 Apr 2017
                </td>
                <td>
                  <span class="badge bg-warning me-1"></span> Pending
                </td>
                <td>$1200</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001403</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                <td>
                  <span class="flag flag-country-de"></span>
                  Bluewolf
                </td>
                <td>
                  87952621
                </td>
                <td>
                  23 Oct 2017
                </td>
                <td>
                  <span class="badge bg-warning me-1"></span> Pending
                </td>
                <td>$534</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001404</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                <td>
                  <span class="flag flag-country-br"></span>
                  Salesforce
                </td>
                <td>
                  87953421
                </td>
                <td>
                  2 Sep 2017
                </td>
                <td>
                  <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                </td>
                <td>$1500</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001405</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a></td>
                <td>
                  <span class="flag flag-country-pl"></span>
                  Printic
                </td>
                <td>
                  87956621
                </td>
                <td>
                  29 Jan 2018
                </td>
                <td>
                  <span class="badge bg-danger me-1"></span> Paid Today
                </td>
                <td>$648</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001406</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a></td>
                <td>
                  <span class="flag flag-country-br"></span>
                  Tabdaq
                </td>
                <td>
                  87956621
                </td>
                <td>
                  4 Feb 2018
                </td>
                <td>
                  <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                </td>
                <td>$300</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001407</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo & Print</a></td>
                <td>
                  <span class="flag flag-country-us"></span>
                  Apple
                </td>
                <td>
                  87956621
                </td>
                <td>
                  22 Mar 2018
                </td>
                <td>
                  <span class="badge bg-success me-1"></span> Paid Today
                </td>
                <td>$2500</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
              <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001408</span></td>
                <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                <td>
                  <span class="flag flag-country-pl"></span>
                  Tookapic
                </td>
                <td>
                  87956621
                </td>
                <td>
                  13 May 2018
                </td>
                <td>
                  <span class="badge bg-success me-1"></span> Paid Today
                </td>
                <td>$940</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#">
                        Action
                      </a>
                      <a class="dropdown-item" href="#">
                        Another action
                      </a>
                    </div>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer d-flex align-items-center">
          <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
          <ul class="pagination m-0 ms-auto">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                prev
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    function myFunction() {
      var id = 1;
        $.ajax({
          url: "{{ route('admin.transaction.listsubscriptions',['id' => "+id+"]) }}",
          type: 'GET',
          data: {
              id: id
          },
          success: function (data) {
            var x = document.getElementById("revenue-chart").value;
            if(x == '3months'){
              var z = document.getElementById("chart-rev-sum");
              z.innerHTML = '<div class="h1 mb-3 me-2">@currency($revenueSummaryThreeMonths)</div>';
              // hide chart 30 days and 7 days
              document.getElementById("3monthschart").classList.remove('d-none');
              document.getElementById("30dayschart").classList.add('d-none');
              document.getElementById("7dayschart").classList.add('d-none');

            }
            if(x == '30days'){
              var z = document.getElementById("chart-rev-sum");
              z.innerHTML = '<div class="h1 mb-3 me-2">@currency($revenueSummaryThirtyDays)</div>';
              // hide chart 3 months and 7 days
              document.getElementById("30dayschart").classList.remove('d-none');
              document.getElementById("3monthschart").classList.add('d-none');
              document.getElementById("7dayschart").classList.add('d-none');

            }
            if(x == '7days'){
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

  <script src="{{ $revenueChartThreeMonths->cdn()}}"></script>
	{{ $revenueChartThreeMonths->script() }}

  <script src="{{ $revenueChartThirtyDays->cdn()}}"></script>
  {{ $revenueChartThirtyDays->script() }}

  <script src="{{ $revenueChartSevenDays->cdn()}}"></script>
  {{ $revenueChartSevenDays->script() }}

  


@endsection