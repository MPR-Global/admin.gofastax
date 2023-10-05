@extends('adminlte::page')

@section('title', 'Meet the team')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
@stop
@section('content_header')
<h1>
    Meet the team
</h1>
@stop
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="box-footer mb-2">
                        <a href="{{route('meettheteam.add')}}" class="btn btn-primary">Add Team Member</a>
                    </div>
                    <div class="table-responsive">
                        <div class="float-right  ml-2">
                            <input type="checkbox" id="deletedFilter">
                            <label for="deletedFilter">Show Deleted</label>
                        </div>
                        <table id="meetTheTeam" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Sequence</th>
                                    <th>Headshot image</th>
                                    <th>Leave me a review link</th>
                                    <th>My review link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#meetTheTeam').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("meettheteam.datatable") }}', // Your route
                type: 'POST',
                "datatype": "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            order: [
                [3, 'asc']
            ],
            columns: [{
                    data: 'id',
                },
                {
                    data: 'name',
                },
                {
                    data: 'title',
                },
                {
                    data: 'sequence',
                },
                {
                    data: 'profile_img',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return data ? '<img src="' + data + '" alt="Profile Image" height="100">' : 'No Image';
                        }
                        return data;
                    }
                },
                {
                    data: 'leave_me_review_link',
                    orderable: false,
                },
                {
                    data: 'review_link',
                    orderable: false,
                },
                {
                    data: 'status',
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        // Edit button
                        if (row.status === 'Deleted') {
                            // Show activate button
                            return `<form method="POST" action="/activateTeamMember/${data.id}">
                                    @csrf
                                <button data-id="${data.id}" data-member="${data.name}" class="btn btn-sm btn-success activate">Activate</button>
                            </form>`;
                        } else {
                            return ` <a href="meetTheTeam/${data.id}/edit" title="Edit Record" class="btn btn-sm btn-info">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form method="POST" action="meetTheTeam/${data.id}/delete">
                                    @csrf
                                    <a href="#" data-id="${data.id}" data-member="${data.name}" class="btn btn-sm btn-danger show_confirm" title="Delete Record">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </form>`;
                        }
                    }
                }
            ]
        });

        $('#deletedFilter').on('change', function() {
            var isChecked = $(this).prop('checked');
            table.column(7).search(isChecked ? '1' : '').draw();
        });
    });
</script>

<script>
    $(document).on('click', '.show_confirm', function(e) {
        e.preventDefault(); // Prevent the default click behavior
        var form = $(this).closest("form");

        let id = $(this).data('id');
        let member = $(this).data('member');
        swal({
            title: "Are you sure?",
            text: `You want to delete this (${member}) Team Member?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(willDelete) {
            if (willDelete) {
                form.submit();
            }
        });
    });

    $(document).on('click', '.activate', function(e) {
        e.preventDefault(); // Prevent the default click behavior
        var form = $(this).closest("form");
        let member = $(this).data('member');
        swal({
            title: "Are you sure?",
            text: `You want to Activate this (${member}) Team Member?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(willDelete) {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@stop