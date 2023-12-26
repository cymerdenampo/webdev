@extends('parent')
@extends('layouts.app')

@section('main') 
    <h3 align="center"><strong>Contacts</strong></h3>

    <div class="float-right">
        <a href="{{ route('crud.create') }}" class="btn btn-success btn-sm"><i class="fa-solid fa-user-plus"></i> Add</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="row float-right mb-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="search" id="form1" class="form-control" placeholder="Search" oninput="filterContacts()" />
            </div>
        </div>
        <div class="col-md-0">
            <div class="input-group">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table style="margin-top: 20px" class="searchable table table-bordered table-striped">
        <tr>
            <th width="20%">Name</th>
            <th width="20%">Company</th>
            <th width="20%">Phone</th>
            <th width="20%">Email</th>
            <th width="20%"></th>
        </tr>
        @foreach ($data as $row)
            <tr class="contact-row">
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->company }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <form action="{{ route('crud.destroy', $row->id) }}" method="post"
                        id="delete-form-{{ $row->id }}">
                        {{-- <a href="{{ route('crud.show', $row->id) }}" class="btn btn-primary">Show</a> --}}
                        <a href="{{ route('crud.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $row->id }})"
                            class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function filterContacts() {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = document.getElementById("form1");
            filter = input.value.toUpperCase();
            table = document.querySelector(".searchable");
            tr = table.getElementsByTagName("tr");
            found = false;

            for (i = 0; i < tr.length; i++) {
                var matchFound = false;
                td = tr[i].getElementsByTagName("td");

                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            matchFound = true;
                            found = true;
                            break;
                        }
                    }
                }

                if (matchFound) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }

            if (!found) {
                var noResultRow = table.insertRow(-1);
                var cell = noResultRow.insertCell(0);
                cell.colSpan = "5"; // Adjust the colspan to match the number of columns
                cell.innerHTML = "No results found.";
            }
        }
    </script>
@endpush



@push('css')
    <style>
        .row {
            margin-right: -26px;
            margin-left: 701px;
        }
    </style>
@endpush
