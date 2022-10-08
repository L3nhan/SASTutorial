@extends('layouts.dashboard')
@section('title', 'Customers')
@section('addnew')
<a href="/customers/create" class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> Add new</a>
@endsection
@section('content')
@if (Session::has('success'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">


        <table id="customersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tax Number</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Unpaid</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tax Number</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Unpaid</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->customerID }}</td>
                    <td>{{ $customer->customerName }}</td>
                    <td>{{ $customer->taxNumber }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>${{ $customer->unpaid }}</td>
                    <td class="text-center">
                        <a
                            href="/customers/checkstatus/{{$customer->customerID}}">{{$customer->status?'Active':'Inactive'}}</a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="mx-auto">
                                <a href="update/{{ $customer->customerID }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i></a>
                            </div>
                            <div class="mx-auto">
                                <a href="delete/{{ $customer->customerID }}" class="delete btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<script>
    $(document).ready(function() {
            $('#customersTable').DataTable();
        });
</script>

{{--  Delete Alert  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    $(".delete").confirm({
        title: '<span style="color: red"><i class="fas fa-trash"></i>&nbsp; Delete Customer</span>',
        content: "<span style='color: black; font-size: 14px'>Are you sure about delete this Customer?</span>",
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm:{
                text: 'Yes I am',
                btnClass: 'btn-red',
                action: function () {
                location.href = this.$target.attr('href');
            }},
            cancel: function () {
            }
        }
    });
</script>
@endsection
