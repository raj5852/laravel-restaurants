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
                    <h1 class="m-0">Tax Management</h1>
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
                                <th>Tax Name</th>
                                <th>Tax Percentage</th>
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
                                <label for="">Tax Name</label>
                                <input type="text" class="form-control" id="taxname" required>

                                <label for="">Tax Percentage (%)</label>
                                <input type="number" class="form-control" id="taxpercentage" required>
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
                                <label for="">Tax Name</label>
                                <input type="text" class="form-control" id="updatetaxname" required>

                                <label for="">Tax Percentage (%)</label>
                                <input type="number" class="form-control" id="updatetaxpercentage" required>
                                <button id="updateButton" type="submit" class="btn btn-primary mt-2">Add</button>

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
            ajax: "{{ route('taxget') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'percentage',
                    name: 'percentage'
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
            var name = $("#taxname").val();
            var percentage = $("#taxpercentage").val();
            $('#addButton').prop('disabled', true);
            $.ajax({
                url: "{{ route('taxcreate') }}",
                method: 'post',
                data: {
                    name: name,
                    percentage: percentage
                },
                success: function(data) {
                    console.log(data)
                    if (data.status == 'true') {
                        $("#myModal").modal('hide');
                        $("#taxname").val('');
                        $("#taxpercentage").val('');
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

            var name = $("#updatetaxname").val();
            var percentage = $("#updatetaxpercentage").val();
            $("#updateButton").prop('disabled', true)
            $.ajax({
                url: "{{ route('taxupdate') }}",
                method: 'post',
                data: {
                    id: id,
                    name: name,
                    percentage: percentage
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
            url: "{{ route('taxedit') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data.data);
                if (data.data) {
                    $("#hiddenId").val(data.data.id)
                    $("#updateModal").modal("show")

                    $("#updatetaxname").val(data.data.name);
                    $("#updatetaxpercentage").val(data.data.percentage);
                }

            }
        })


    }

    function deleteData(id) {
        var text = "Are you sure for delete it?"
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('taxdelete') }}",
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
                url: "{{ route('taxstatus') }}",
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