@extends('template')

@php
    $title = "Home";
    $pretitle = "Home";
@endphp


@section('body')
<style>
    .card-content:hover {
        background-color: rgba(0, 111, 238, 0.5); /* Biru dengan opacity 0.5 */
        cursor: pointer;
    }
    a:hover {
      text-decoration: none;
      /* color:black; */
    }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var element = document.getElementById('typed-output');
      var text = "{{ explode(' ', Auth()->user()->fullname)[0] }}";

      function typeText() {
          var i = 0;
          var typing = setInterval(function () {
              if (i < text.length) {
                  element.innerHTML += text.charAt(i);
                  i++;
              } else {
                  clearInterval(typing);
                  setTimeout(function () {
                      deleteText();
                  }, 3000); // Jeda sebelum menghapus teks
              }
          }, 50); // Kecepatan pengetikan (ms)
      }

      function deleteText() {
          var i = element.innerHTML.length - 1;
          var deleting = setInterval(function () {
              if (i >= 0) {
                  element.innerHTML = element.innerHTML.slice(0, i);
                  i--;
              } else {
                  clearInterval(deleting);
                  setTimeout(function () {
                      typeText();
                  }, 1000); // Jeda sebelum memulai kembali pengetikan
              }
          }, 50); // Kecepatan penghapusan (ms)
      }

      typeText(); // Memulai animasi pengetikan saat dokumen dimuat
  });
</script>
<div class="row row-deck row-cards">
    <div class="contabiner d-flex justify-content-center align-items-center mt-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1>Welcome, <span id="typed-output"></span></h1>
            <p class="fs-2">Let’s get you set up with This Workspace.</p>
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <a href="{{ route('workspace.invoice') }}">
              <div class="card h-80 text-center mx-auto card-content">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('images/invoicedashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><strong>Send a test invoice</strong></h5>
                  <p class="card-text">See how invoices look, and how fast and easy it is to create one.    </p>
                </div>
              </div>
            </a>
            </div>
            <div class="card h-80 text-center mx-auto card-content">
            <div class="col">
              <a href="{{ route('workspace.subscriptions.upgradeshow') }}" style="text-decoration: none;">
                  <div class="d-flex justify-content-center">
                      <img src="{{ asset('images/paymentdashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><strong>Enable online payments</strong></h5>
                    <p class="card-text">Get paid to faster</p>
                  </div>
                </a>
                </div>
              </div>
              <div class="col">
              <a href="{{ route('workspace.transaction.show') }}" style="text-decoration: none; color:black;">
                <div class="card h-80 text-center mx-auto card-content">
                  <div class="d-flex justify-content-center">
                      <img src="{{ asset('images/transactiondashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><strong>Add reccuring expenses</strong></h5>
                    <p class="card-text">Set them up and we'll record recurring expenses automatically</p>
                  </div>
                </div>
              </a>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-12 text-center mt-3">
    <div class="card">
        <div class="card-header">
          <div>
            <div class="row align-items-center">
              <div class="col">
                <div class="card-title">
                    <h2>Tasks</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
            <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="tabs-to-do" role="tabpanel">
                      <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable table-hover">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th class="text-start">Title</th>
                                    <th>Status</th>
                                    <th class="w-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                              $i = 1 + ($tasks->currentPage() - 1) * $tasks->perPage();
                          @endphp
                                @foreach ($tasks as $task)
                                <tr>
                                    <td></td>
                                    <td class="text-start fs-3">{{ $task->tasks }}</td>
                                    <td>
                                      <a href="#" class="text-warning dropdown-toggle">On Progress</a>
                                      
                                    </td>
                                    <td>
                                      <form action="{{ route('workspace.dashboard.destroyTasks', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <form action="{{ route('workspace.dashboard.storeTasks') }}" method="POST"> 
                                  @csrf
                                <tr>
                                    <td></td>
                                    <td><input class="form-control" type="text" name="tasks" placeholder="Title"></td>
                                    <td><button class="btn btn-primary" type="submit">Save</button></td>
                                  </form>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-footer d-flex align-items-center ms-auto">
                          {!! $tasks->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      </div>
</div>
    {{-- <a id="showMore" class="text-center dropdown-toggle" style="text-decoration: none; cursor: pointer; color:gray;"><strong> Show more</strong></a>      --}}
</div>
@if(session('emptyData'))
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
     $(document).ready(function() {
            // Tampilkan notifikasi alert
            var alertDiv = document.createElement('div');
            alertDiv.classList.add('alert', 'alert-important', 'alert-danger', 'alert-dismissible', 'position-fixed', 'top-0', 'end-0', 'm-3');
            alertDiv.setAttribute('role', 'alert');
            alertDiv.style.zIndex = '9999'; // Menentukan indeks z untuk memastikan notifikasi muncul di atas elemen lain

            alertDiv.innerHTML = `
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 8v4"></path>
                            <path d="M12 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                      <strong>
                        {{ session('emptyData') }}
                      </strong>
                    </div>
                </div>
                <button type="button" class="btn-close" aria-label="Close"></button>
            `;

            // Tambahkan notifikasi alert ke dalam dokumen
            document.body.appendChild(alertDiv);

            // Tambahkan animasi fadeout saat tombol close di notifikasi diklik
            $(document).on('click', '.btn-close', function() {
                $(alertDiv).fadeOut(500, function() {
                    $(this).remove();
                });
            });

            // Hilangkan notifikasi setelah 5 detik
            setTimeout(function () {
                $(alertDiv).fadeOut(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endif

@endsection