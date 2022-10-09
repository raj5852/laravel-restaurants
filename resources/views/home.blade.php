  @extends('admin.layouts.app')
  @section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <style>
    .borderStyle {
      border-left: 4px solid blue;
    }
  </style>
  @endsection
  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"></div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Today Sales</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today}} </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      Yesterday Sales</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{$yesterday}} </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Last 7 Day Sales
                    </div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{$sevendays}}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      All Time Sales</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{$all}}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row">
                  <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Live Table Status</h6>
                  </div>
                  <div class="col" align="right">

                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="table_status">
                  <div class="row" id="addTable">


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection
  @section('js')

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function callTable() {
      $.ajax({
        url: '{{ route("callTable") }}',
        method: 'post',
        success: function(data) {
          if (data.data) {
            var text = ""
            var arr = data.data
            arr.forEach(myFUnc)
            document.getElementById("addTable").innerHTML = text;
            console.log(text);

            function myFUnc(item, index) {
              if (item.order.length == 0) {

                text += '<div class="col-lg-2 mb-3"><div class="card bg-light text-black shadow"><div class="card-body">' + item.name + '<div class="mt-1 text-black-50 small">' + item.capacity + '</div></div></div></div>'

              } else {
                text += '<div class="col-lg-2 mb-3"><div class="card bg-primary text-black shadow"><div class="card-body">' + item.name + '<div class="mt-1 text-black-50 small">' + item.capacity + '</div></div></div></div>'
              }
            }
          }
        }
      })
    }
    callTable();
  </script>


  @endsection