@extends("layouts.admin")

@section("content")
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Manage Properties</h5>
                            <div class="d-flex justify-content-between">
                                {{ $properties->links() }}
                                <a href="{{ route("admin.properties.create") }}"><span class="bg-primary rounded text-light px-3 py-2">Add New</span></a>
                            </div>
                            <div class="table-responsive">
                                <x-table :keys="$keys" :data="$properties->items()" entities="properties" :hasButtons="true"></x-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
