@props(["property" => null, "key" => 0])
{{--@php dd($key) @endphp--}}
<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="property-item rounded overflow-hidden">
        <div class="position-relative overflow-hidden">
            <a href="{{route("properties.show", ["id" => $key])}}"><img class="img-fluid" src="{{ asset("assets/theme/img") . '/' . $property->image . '.jpg' }}" alt="{{ $property->image }}"></a>
            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $property->type }}</div>
            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $property->category }}</div>
        </div>
        <div class="p-4 pb-0">
            <h5 class="text-primary mb-3">${{ $property->price }}</h5>
            <a class="d-block h5 mb-2" href="">{{ $property->title }}</a>
            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
        </div>
        <div class="d-flex border-top">
            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->area }}m²</small>
            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->rooms }}</small>
            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }}</small>
        </div>
    </div>
</div>
