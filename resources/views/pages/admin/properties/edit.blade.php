@extends("layouts.admin")

@section("content")
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 d-flex align-items-stretch">
                    <div class="card w-100 shadow">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Edit a Property</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.properties.update', $property->id) }}">
                                @CSRF
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $property->title }}">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ $property->description }}</textarea>
                                </div>

                                <div class="mb-3 d-flex justify-content-start align-items-center">
                                    <div class="mb-3 me-2">
                                        <label for="area" class="form-label">Area (m²)</label>
                                        <input type="number" class="form-control" id="area" name="area" value="{{ $property->area }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price ($)</label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $property->price }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div class="mb-3 me-2">
                                        <label for="floors" class="form-label">Floors</label>
                                        <input type="number" class="form-control" id="floors" name="floors" value="{{ $property->floors }}">
                                    </div>
                                    <div class="mb-3 me-2">
                                        <label for="rooms" class="form-label">Rooms</label>
                                        <input type="number" class="form-control" id="rooms" name="rooms" value="{{ $property->rooms }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bathrooms" class="form-label">Bathrooms</label>
                                        <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ $property->bathrooms }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div class="mb-3 me-2">
                                        <label for="category_id" class="form-label">Categories</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="0">Choose a category</option>
                                            @foreach($categories as $key => $name)
                                                <option {{ $name === $property->category ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 me-2">
                                        <label for="heating_id" class="form-label">Heating</label>
                                        <select class="form-select" id="heating_id" name="heating_id">
                                            <option value="0">Choose heating</option>
                                            @foreach($heating as $key => $name)
                                                <option {{ $name === $property->heating ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 me-2">
                                        <label for="type" class="form-label">Types</label>
                                        <select class="form-select" id="type" name="type">
                                            <option value="0">Choose a type</option>
                                            @foreach($types as $key => $name)
                                                <option {{ $name === $property->type ? 'selected="selected"' : '' }} value="{{ $key+1 }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="seller_id" class="form-label">Sellers</label>
                                        <select class="form-select" id="seller_id" name="seller_id">
                                            <option value="0">Choose a Seller</option>
                                            @foreach($users as $key => $name)
                                                <option {{ $name === $property->seller ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="featuredC" class="form-label">Featured</label>
                                    <input type="checkbox" class="form-check" id="featuredC" name="featured-c" value="{{ $property->featured }}" {{ $property->featured == 1 ? "checked=checked" : '' }} />
                                </div>

                                <input type="submit" class="btn btn-primary" value="Update"/>
                                {{--onclick="$(this).hasAttribute('checked') ? $(this).removeAttr('checked') : ''"--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
