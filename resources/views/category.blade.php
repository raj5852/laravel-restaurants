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
                    <h1 class="m-0">Category Management</h1>
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
                    <div class="text-right">
                        <button onclick="openModal()" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create</button>

                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Category Name</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="handleAjax" method="post">

                    <label for="">Category</label>
                    <input type="text" id="category" class="form-control" required>
                    <span id="alertBX" class="text-center text-danger" style="display: none;">The category field is required.</span><br>
                    <button id="addButton" type="submit" class="btn btn-success">Add</button>
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
                    <label for="">Category</label>
                    <input type="text" id="UpdateCategory" class="form-control" required>
                    <span id="alertBX" class="text-center text-danger" style="display: none;">The category field is required.</span><br>
                    <button id="updateButton" type="submit" class="btn btn-success">Update</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getcategory') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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
        });
        $("#handleAjax").on("submit", function(e) {
            e.preventDefault();
            var categoryName = $("#category").val()
            $('#addButton').prop('disabled', true);
            $.ajax({
                url: "{{ route('categorycreate') }}",
                method: 'post',
                data: {
                    category: categoryName
                },
                success: function(data) {
                    if (data.message == 'false') {
                        $("#alertBX").show();
                        $('#addButton').prop('disabled', false);

                    }
                    if (data.message == 'true') {
                        $("#myModal").modal('hide');
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                        $('#addButton').prop('disabled', false);

                    }

                }
            })
        });
        $("#updateForm").on('submit', function(e) {
            e.preventDefault();
            var id = $('#hiddenId').val();
            var category = $("#UpdateCategory").val()
            $("#updateButton").prop('disabled', true)
            $.ajax({
                url: "{{ route('categoryupdate') }}",
                method: 'post',
                data: {
                    id: id,
                    category: category
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
        $("#category").val('')
        $("#alertBX").hide();
    }

    function deleteData(id) {
        const text = "Are you Sure?"
        if (confirm(text) == true) {
            $.ajax({
                type: 'POST',
                url: "{{ route('categorydelete') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    var oTable = $('.yajra-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            })
        }
    }

    function edit(id) {
        $.ajax({
            url: "{{ route('editrequest') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data.data);
                $("#hiddenId").val(id)
                $("#UpdateCategory").val(data.data)
            }
        })


    }

    function status(id) {
        var text = "Are you sure ?";
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('categorystatus') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    // console.log(data)
                    if (data) {

                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })
        }
    }
</script>
@endsection