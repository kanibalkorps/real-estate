@extends("layouts.admin")

@section("content")
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Manage Users</h5>
                            <div class="d-flex justify-content-between">
                                {{ $users->links() }}
                                <a href="{{ route("admin.users.create") }}"><span class="bg-primary rounded text-light px-3 py-2">Add New</span></a>
                            </div>
                            <div class="table-responsive">
                                <x-table :keys="$keys" :data="$users->items()" entities="users" :hasButtons="true"></x-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
