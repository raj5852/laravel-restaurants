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
                    <h1 class="m-0">Order Area</h1>
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
                <div class="col col-sm-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">Table Status</div>
                        <div class="card-body" id="table_status">

                            <!-- here is tables  -->
                        </div>
                    </div>
                </div>
                <div class="col col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">Order Status</div>
                        <div class="card-body">
                            <div class="table-responsive" id="order_status">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <input type="hidden" id="tableIdforReload">
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="table_item">
                                <input type="hidden" id="tableid">
                                <!-- <input type="hidden" id="productid">-->
                                <label for="">Category</label>
                                <select class="form-control" name="select_category" id="select_category" required>
                                    <option value="">Select Category</option>
                                    @foreach($categorys as $category)

                                    <option value="{{ $category->name }}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                                <label for="">Product Name</label>
                                <select class="form-control" name="productname" id="productname" required>
                                    <option value="">Select Product Name</option>

                                </select>
                                <label for="">Quantity</label>
                                <select class="form-control" name="Quantity" id="Quantity" required>
                                    <option value="">Select Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>


                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary" id="addButton">Add</button>
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $('#select_category').on('change', function() {
            var val = $(this).find(":selected").val()
            $.ajax({
                url: '{{ route("orderproduct") }}',
                method: 'post',
                data: {
                    val: val
                },
                success: function(data) {

                    if (data.status) {

                        var text = ""
                        var arr = data.status
                        arr.forEach(myFun)
                        document.getElementById("productname").innerHTML = text

                        function myFun(item, index) {
                            text += "<option value=" + item.id + ">" + item.name + "</option>"
                        }
                    }

                }
            })
        });



        $("#table_item").on('submit', function(e) {
            e.preventDefault();

            var tableid = $("#tableid").val();
            var category = $("#select_category").val();
            var productname = $("#productname").val();
            var quantity = $("#Quantity").val()
            var productid = $("#productname").val()

            $("#addButton").prop('disabled', true)


            $.ajax({
                url: "{{ route('tablesubmit') }}",
                method: 'post',
                data: {
                    category: category,
                    productname: productname,
                    quantity: quantity,
                    tableid: tableid,
                    productid: productid
                },
                success: function(data) {
                    $("#myModal").modal('hide')
                    $("#addButton").prop('disabled', false)
                    tableLoad(tableid)
                    callTable()


                }
            })

        })




    })

    function deletestatus(id) {
        // console.log(id)
        var text = "Are you sure?"
        if (confirm(text) == true) {
            $.ajax({
                url: '{{ route("deletestatus") }}',
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status) {
                        console.log("delete success")
                        callTable()
                        var tableIdforReload = $("#tableIdforReload").val()
                        tableLoad(tableIdforReload)
                    }
                }
            })
        }


    }

    function callTable() {
        $.ajax({
            url: '{{ route("callTable") }}',
            method: 'post',
            success: function(data) {
                // console.log()
                if (data.data) {
                    var text = ""
                    var arr = data.data
                    arr.forEach(myFUnc)
                    // console.log(text)
                    document.getElementById("table_status").innerHTML = text;

                    function myFUnc(item, index) {
                        if (item.order.length == 0) {
                            text += ' <button onclick="modalShow(' + item.id + ')" type="button" name="table_button" id="' + item.id + '" class="btn btn-secondary mb-4 table_button">' + item.name + '<br>' + item.capacity + '</button>'
                        } else {
                            text += ' <button onclick="modalShow(' + item.id + ')" type="button" name="table_button" id="' + item.id + '" class="btn btn-success mb-4 table_button">' + item.name + '<br>' + item.capacity + '</button>'
                        }
                    }
                }
            }
        })
    }
    callTable();

    function tableLoad(id) {

        $.ajax({
            url: '{{ route("ordercall") }}',
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                if (data.data) {
                    $(".colbackend").remove();

                    var text = ""

                    var arr = data.data
                    arr.forEach(myFun)

                    $("tbody").append(text)

                    function myFun(item, index) {
                        text += "<tr class='colbackend'><td>" + item.itemname + "</td><td>" + item.quantity + "</td><td>" + item.rate + "</td><td>" + item.amount + "</td><td><button class='btn btn-danger' onclick='deletestatus(" + item.id + ")'>Delete</button></td></tr>"
                    }

                }
            }
        })



    }

    function modalShow(id) {
        $("#tableIdforReload").val(id)
        $("#tableid").val(id);
        $("#myModal").modal('show');
        $("#select_category").val('')
        $("#Quantity").val('')
        $.ajax({
            url: '{{ route("ordercall") }}',
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                if (data.data) {
                    $(".colbackend").remove();

                    var text = ""

                    var arr = data.data
                    arr.forEach(myFun)

                    $("tbody").append(text)

                    function myFun(item, index) {
                        text += "<tr class='colbackend'><td>" + item.itemname + "</td><td>" + item.quantity + "</td><td>" + item.rate + "</td><td>" + item.amount + "</td><td><button class='btn btn-danger' onclick='deletestatus(" + item.id + ")' >Delete</button></td></tr>"
                    }

                }
            }
        })



    }
</script>

@endsection