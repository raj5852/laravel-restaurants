<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center;">Tasty Food which we make</h3><br>
    <p style="text-align: center;">1391 Westfall Avenue, NYC, NY</p>
    <p style="text-align: center;"><b>Contact No.</b> - 8523697410</p>
    <p style="text-align: center;"><b>Email:</b> food@gmail.co</p>
    <div style="display: flex;">
        <div style="margin-left: 20px;"><b>Table Name:</b> {{$bill['tablename']}} </div>
        <div style="margin-left: 20px;"><b>Order Number:</b> {{$bill['ordernumber']}} </div>
        <div style="margin-left: 20px;"><b>Time:</b> {{$bill['created_at']}} </div>

    </div><br>
    <table>
        <tr>
            <th><b>Item Name</b> </th>
            <th><b>Quantity</b> </th>
            <th><b>Rate</b></th>
            <th><b>Amount</b></th>
        </tr>
        @foreach($employee ?? '' as $data)
        <tr>
            <td> {{$data['itemname']}} </td>
            <td> {{$data['quantity']}} </td>
            <td> {{$data['rate']}} </td>
            <td> {{$data['amount']}} </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="4" align="right"> <b>Total Bill</b>: {{$sum}} </td>
        </tr>
        
    </table>


</body>

</html>