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
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
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
                                <label for="">Category</label>
                                <select id="category" id="" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categorys as $category)
                                    <option value="{{$category->name}}">{{ $category->name }}</option>

                                    @endforeach
                                </select>
                                <label for="">Product Name</label>
                                <input id="name" type="text" class="form-control" required>
                                <label for="">Product Price</label>
                                <input id="price" type="number" class="form-control" required>
                                <button id="addButton" type="submit" class="btn btn-primary mt-2"> Add</button>

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
                                <select id="UPcategory" class="form-control">
                                    @foreach($categorys as $category)
                                    <option value="{{$category->name}}">{{ $category->name }}</option>

                                    @endforeach
                                </select>
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" id="UPname">

                                <label for="">Product Price</label>
                                <input type="number" class="form-control" id="UPprice">

                                <button id="updatebutton" class="btn btn-primary mt-2">Update</button>

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
            ajax: "{{ route('getproduct') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'category',
                    name: 'category'
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
            var category = $("#category").val();
            var name = $("#name").val();
            var price = $("#price").val();
            $('#addButton').prop('disabled', true);
            $.ajax({
                url: "{{ route('productcreate') }}",
                method: 'post',
                data: {
                    category: category,
                    name: name,
                    price: price
                },
                success: function(data) {
                    // console.log(data)
                    if (data.status == 'true') {
                        $("#myModal").modal('hide');
                        $("#category").val('');
                        $("#name").val('');
                        $("#price").val('');

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
            var category = $("#UPcategory").val();
            var name = $("#UPname").val();
            var price = $("#UPprice").val();
            $("#updatebutton").prop('disabled', true)
            $.ajax({
                url: "{{ route('productupdate') }}",
                method: 'post',
                data: {
                    id: id,
                    category: category,
                    name: name,
                    price: price,
                },
                success: function(data) {
                    if (data.status) {
                        $("#updateModal").modal('hide');
                        $("#updatebutton").prop('disabled', false)
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                        $('#addButton').prop('disabled', false);
                        
                    }


                }
            })
        })
    })

    function openModal() {
        $('#addButton').prop('disabled', false);
    }

    function edit(id) {
        $.ajax({
            url: "{{ route('productedit') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data.data);
                if (data.data) {

                    $("#updateModal").modal("show")
                    $("#hiddenId").val(data.data.id)
                    $("#UPcategory").val(data.data.category);
                    $("#UPname").val(data.data.name);
                    $("#UPprice").val(data.data.price);
                }

            }
        })


    }

    function deleteData(id) {
        var text = "Are you sure for delete it?"
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('productdelete') }}",
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
                url: "{{ route('productstatus') }}",
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