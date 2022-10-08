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
                    <h1 class="m-0">User Management</h1>
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
                                <th>Image</th>
                                <th>User Name</th>
                                <th>User Contract No.</th>
                                <th>User Email</th>
                                <th>User Password</th>
                                <th>User Type</th>
                                <th>Created On</th>
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

                            <form id="handleAjax" method="post" enctype="multipart/form-data">
                                <label for="">User Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                <label for="">User Contact No. <span class="text-danger">*</span> </label>
                                <input type="number" name="contract" id="contract" class="form-control" required>
                                <label for="">User Email <span class="text-danger">*</span> </label>
                                <input type="email" name="email" id="email" class="form-control" required>
                                <label for="">User Password <span class="text-danger">*</span> </label>
                                <input type="text" name="password" id="password" class="form-control" required>
                                <label for="">User Type <span class="text-danger">*</span> </label>

                                <select name="user_type" id="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Waiter">Waiter</option>
                                    <option value="Cashier">Cashier</option>
                                </select>
                                <label for="">User Profile</label>
                                <input type="file" name="file" id="file" class="form-control">
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

                            <form id="updateForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="UPhiddenId" id="UPhiddenId">
                                <label for="">User Name <span class="text-danger">*</span> </label>
                                <input type="text" name="UPname" id="UPname" class="form-control" required>
                                <label for="">User Contact No. <span class="text-danger">*</span> </label>
                                <input type="number" name="UPcontract" id="UPcontract" class="form-control" required>
                                <label for="">User Email <span class="text-danger">*</span> </label>
                                <input type="email" name="UPemail" id="UPemail" class="form-control" required>
                                <label for="">User Password <span class="text-danger">*</span> </label>
                                <input type="text" name="UPpassword" id="UPpassword" class="form-control" required>
                                <label for="">User Type <span class="text-danger">*</span> </label>

                                <select name="UPuser_type" id="UPuser_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Waiter">Waiter</option>
                                    <option value="Cashier">Cashier</option>
                                </select>
                                <label for="">User Profile</label>
                                <input type="file" name="UPfile" id="UPfile" class="form-control">
                                <button id="updateButton" type="submit" class="btn btn-primary mt-2"   >Update</button>

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
            ajax: "{{ route('getuser') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'contract',
                    name: 'contract'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'password',
                    name: 'password'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'createdon',
                    name: 'createdon'
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
            $("#addButton").prop('disabled', true)

            $.ajax({
                url: "{{ route('usercreate') }}",
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#myModal").modal('hide');
                    $("#contract").val('')
                    $("#createdon").val('')
                    $("#email").val('')
                    $("#file").val('')
                    $("#name").val('')
                    $("#password").val('')
                    $("#status").val('')
                    $("#type").val('')

                    $("#addButton").prop('disabled', false)
                    var oTable = $('.yajra-datatable').dataTable();
                    oTable.fnDraw(false);


                }
            })
        })


        $("#updateForm").on('submit', function(e) {
            e.preventDefault();

            $("#updateButton").prop('disabled', true)
            $.ajax({
                url: "{{ route('userupdate') }}",
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.data) {
                        $("#updateModal").modal('hide');
                        $("#updateButton").prop('disabled', false)
                        var oTable = $('.yajra-datatable').dataTable();
                        oTable.fnDraw(false);
                        $("#UPfile").val('')

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
            url: "{{ route('useredit') }}",
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data.data);
                if (data.data) {
                    $("#UPhiddenId").val(data.data.id)
                    $("#updateModal").modal("show")
                    console.log(data.data);
                    $("#UPcontract").val(data.data.contract);
                    $("#UPcreatedon").val(data.data.createdon);
                    $("#UPemail").val(data.data.email);
                    $("#UPname").val(data.data.name);
                    $("#UPpassword").val(data.data.password);
                    $("#UPstatus").val(data.data.status);
                    $("#UPuser_type").val(data.data.type);




                }

            }
        })


    }

    function deleteData(id) {
        var text = "Are you sure for delete it?"
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('userdelete') }}",
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
                url: "{{ route('userstatus') }}",
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