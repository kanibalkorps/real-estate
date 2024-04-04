@extends("layouts.default")

@section("content")
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 ">
                <div class="col-lg-7 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Take a closer look</h1>
                    <div class="property-item rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <div><img class="w-100 h-auto" src="{{ asset("assets/theme/img") . '/' . $property->image . '.jpg' }}" alt="{{ $property->image }}"></div>
                        </div>
                        <div class="p-4 pb-0">
                            <h5 class="text-primary mb-3">${{ $property->price }}</h5>
                            <h4 class="d-block h5 mb-2">{{ $property->title }}</h4>
                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
                            <hr class="mb-4"/>
                            <div class="container mb-5">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="">Category:</div>
                                        <div class="">Type:</div>
                                        <div class="">Area:</div>
                                        <div class="">Rooms:</div>
                                        <div class="">Bathrooms:</div>
                                    </div>
                                    <div class="col-5">
                                        <span class="text-primary d-block fw-bold">{{ $property->category }}</span>
                                        <span class="text-primary d-block fw-bold">{{ $property->type }}</span>
                                        <span class="text-primary d-block fw-bold">{{ $property->area }}m²</span>
                                        <span class="text-primary d-block fw-bold">{{ $property->rooms }}</span>
                                        <span class="text-primary d-block fw-bold">{{ $property->bathrooms }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-3 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="text-center mb-5">Contact</h2>
                    <form action="{{ route("contact") }}">
                        @CSRF
                        <div class="d-flex justify-content-center align-items-center">
                            <input class="btn-primary text-light p-3 px-5 rounded border-0" type="submit" value="Send the owner an email"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
