@extends("layouts.admin")

@section("content")
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Recent Actions</h5>
                            <div class="table-responsive">
                                {{ $logs->links() }}
                                <div class="table-responsive">
                                    <x-table :keys="$keys" :data="$logs->items()" entities="logs"></x-table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
