@extends("layouts.admin")

@section("content")
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Edit User</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.users.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"/>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"/>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"/>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"/>
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select class="form-control" id="role_id" name="role_id">
                                        <option value="0">Choose a role</option>
                                        @foreach($roles as $id => $name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Update"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
