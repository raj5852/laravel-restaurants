@extends('admin.layouts.app')
@section('css')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />


@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Table Management</h1>
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
            <div class="card">
                <div class="card-header">
                    <div align="right">
                        <button onclick="openModal()" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Table Name</th>
                                <th>Table Capacity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>



            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <form id="handleAjax" method="post">

                                <label for="">Table Name</label>
                                <input type="text" id="tablename" class="form-control" required>
                                <span id="alertBX" class="text-center text-danger" style="display: none;">The category field is required.</span>
                                <label for="" class="mt-2">Table Capacity</label>
                                <select name="table_capacity" id="table_capacity" class="form-control " required="" data-parsley-trigger="change">
                                    <option value="">Select Table Capacity</option>
                                    <option value="1 Person">1 Person</option>
                                    <option value="2 Person">2 Person</option>
                                    <option value="3 Person">3 Person</option>
                                    <option value="4 Person">4 Person</option>
                                    <option value="5 Person">5 Person</option>
                                    <option value="6 Person">6 Person</option>
                                    <option value="7 Person">7 Person</option>
                                    <option value="8 Person">8 Person</option>
                                    <option value="9 Person">9 Person</option>
                                    <option value="10 Person">10 Person</option>
                                    <option value="11 Person">11 Person</option>
                                    <option value="12 Person">12 Person</option>
                                    <option value="13 Person">13 Person</option>
                                    <option value="14 Person">14 Person</option>
                                    <option value="15 Person">15 Person</option>
                                    <option value="16 Person">16 Person</option>
                                    <option value="17 Person">17 Person</option>
                                    <option value="18 Person">18 Person</option>
                                    <option value="19 Person">19 Person</option>
                                    <option value="20 Person">20 Person</option>
                                </select>
                                <button id="addButton" type="submit" class="btn btn-primary mt-2">Add</button>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal" id="updateModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <form id="updateForm" method="post">
                                <input type="hidden" id="hiddenId">
                                <label for="">Table Name</label>
                                <input type="text" id="updateTablename" class="form-control" required>
                                <label for="" class="mt-2">Table Capacity</label>
                                <select name="table_capacity" id="table_capacityUpdate" class="form-control " required="" data-parsley-trigger="change">
                                    <option value="">Select Table Capacity</option>
                                    <option value="1 Person">1 Person</option>
                                    <option value="2 Person">2 Person</option>
                                    <option value="3 Person">3 Person</option>
                                    <option value="4 Person">4 Person</option>
                                    <option value="5 Person">5 Person</option>
                                    <option value="6 Person">6 Person</option>
                                    <option value="7 Person">7 Person</option>
                                    <option value="8 Person">8 Person</option>
                                    <option value="9 Person">9 Person</option>
                                    <option value="10 Person">10 Person</option>
                                    <option value="11 Person">11 Person</option>
                                    <option value="12 Person">12 Person</option>
                                    <option value="13 Person">13 Person</option>
                                    <option value="14 Person">14 Person</option>
                                    <option value="15 Person">15 Person</option>
                                    <option value="16 Person">16 Person</option>
                                    <option value="17 Person">17 Person</option>
                                    <option value="18 Person">18 Person</option>
                                    <option value="19 Person">19 Person</option>
                                    <option value="20 Person">20 Person</option>
                                </select>

                                <button id="updateButton" type="submit" class="btn btn-success mt-2">Update</button>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tableget') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'capacity',
                    name: 'capacity'
                },
                {
                    data: 'statusAction',
                    name: 'statusAction'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        })
        $("#handleAjax").on('submit', function(e) {
            e.preventDefault();
            var tablename = $("#tablename").val();
            var table_capacity = $("#table_capacity").val();
            $('#addButton').prop('disabled', true);
            $.ajax({
                url: "{{ route('tablecreate') }}",
                method: 'post',
                data: {
                    name: tablename,
                    capacity: table_capacity
                },
                success: function(data) {
                    console.log(data)
                    if (data.status == 'true') {
                        $("#myModal").modal('hide');
                        $("#tablename").val('');
                        $("#table_capacity").val('');
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                        $('#addButton').prop('disabled', false);
                    }
                }
            })
        })


        $("#updateForm").on('submit', function(e) {
            e.preventDefault();

            var id = $("#hiddenId").val()

            var name = $("#updateTablename").val();
            var capacity = $("#table_capacityUpdate").val();
            $("#updateButton").prop('disabled', true)
            $.ajax({
                url: "{{ route('tableupdate') }}",
                method: 'post',
                data: {
                    id: id,
                    name: name,
                    capacity: capacity
                },
                success: function(data) {
                    $("#updateModal").modal('hide');
                    $("#updateButton").prop('disabled', false)
                    var oTable = $('.yajra-datatable').dataTable();
                    oTable.fnDraw(false);
                    $('#addButton').prop('disabled', false);

                }
            })
        })
    })

    function openModal() {
        $('#addButton').prop('disabled', false);
    }

    function edit(id) {
        $.ajax({
            url: "{{ route('tablerequest') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data.data);
                if (data.data) {
                    $("#hiddenId").val(data.data.id)
                    $("#updateModal").modal("show")

                    $("#updateTablename").val(data.data.name);
                    $("#table_capacityUpdate").val(data.data.capacity);
                }

            }
        })


    }

    function deleteData(id) {
        var text = "Are you sure?"
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('tabledelete') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.data) {
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })
        }
    }

    function status(id) {
        var text = "Are you sure?"
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('tablestatus') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.message) {
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })
        }
    }
</script>
@endsection