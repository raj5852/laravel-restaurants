  @extends('admin.layouts.app')
  @section('css')
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
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
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
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$564.38</div>
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
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$2235.46</div>
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
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$781834.38</div>
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
                  <div class="row">
                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 1
                          <div class="mt-1 text-black-50 small">2 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 2
                          <div class="mt-1 text-black-50 small">4 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-info text-white shadow">
                        <div class="card-body">
                          Table 3
                          <div class="mt-1 text-white-50 small">Booked</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-info text-white shadow">
                        <div class="card-body">
                          Table 4
                          <div class="mt-1 text-white-50 small">Booked</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 5
                          <div class="mt-1 text-black-50 small">3 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 6
                          <div class="mt-1 text-black-50 small">2 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 7
                          <div class="mt-1 text-black-50 small">4 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 8
                          <div class="mt-1 text-black-50 small">6 Person</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-info text-white shadow">
                        <div class="card-body">
                          Table 9
                          <div class="mt-1 text-white-50 small">Booked</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 mb-3">
                      <div class="card bg-light text-black shadow">
                        <div class="card-body">
                          Table 10
                          <div class="mt-1 text-black-50 small">8 Person</div>
                        </div>
                      </div>
                    </div>
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