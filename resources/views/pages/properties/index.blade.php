@extends("layouts.default")

@section("content")
    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 ">
                <h1 class="mb-3">Property Listing</h1>
                <div class="col-lg-8 text-start wow slideInLeft" data-wow-delay="0.1s">
                    <!-- Search Start -->
                    <div class="container-fluid wow fadeIn" data-wow-delay="0.1s" style="padding: 35px 0 35px 0">
                            <div class="row g-2">
                                <div class="col-md-10">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control py-3" id="searchKeyword"
                                                   placeholder="Search Keyword" onkeyup="sendAjax()"/>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="category" class="form-select py-3" onchange="sendAjax()">
                                                <option value="0">Category</option>
                                                @foreach($categories as $key=>$value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="type" class="form-select py-3" onchange="sendAjax()">
                                                <option value="0">Type</option>
                                                @foreach($types as $key=>$value)
                                                    <option value="{{ $key+1 }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Search End -->
                </div>

                {{ $properties->links() }}
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div id="properties-wrapper" class="row g-4">
                        @foreach($properties as $property)
                            <x-property :property="$property"
                                        :key="$property->id"/>
                        @endforeach

                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="">Browse More Properties</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property List End -->
@endsection

@section("custom-scripts")
    <script>
        $(document).ready(function() {
            $('#custom-pagination').on('click', 'ul.pagination a.page-link', function(e) {
                e.preventDefault();

                $('#custom-pagination ul.pagination li.page-item').removeClass('active').removeAttr('aria-current');
                $(this).parent().addClass('active').attr('aria-current', 'page');

                let page = $(this).attr('href').split('page=')[1];

                sendAjax(page);
            });
        });

        let delayTimer;

        function sendAjax(page = 1){
            let keywords = $("#searchKeyword").val() ? $("#searchKeyword").val() : '0';
            let category = $("#category").val();
            let type = $("#type").val();

            clearTimeout(delayTimer);

            delayTimer = setTimeout(function () {
                ajax("/get-properties/" + keywords + '/' + category + '/' + type + '/?page=' + page, "get",
                    function (result) {
                        printPagination(result.totalPages, page);
                        printProperties(result.items);
                    },
                    function (xhr, status, error) {
                        console.error("Error:", status, error);
                    })
            }, 500);
        }

        function printPagination(totalPages, page){
            let pagination = $('.pagination');
            let elements = '';
            let baseURL = window.location.origin;

            for (let i = 1; i <= totalPages; i++) {
                if (i == page) {
                    elements += '<li class="page-item active" aria-current="page"><span class="page-link">' + i + '</span></li>';
                }
                else {
                    elements += `<li class="page-item"><a class="page-link" href="${baseURL}/get-properties?page=` + i + '">' + i + '</a></li>';
                }
            }

            pagination.html(elements);
        }

        function printProperties(properties) {
            let propertiesWrapper = $("#properties-wrapper");
            let components = '';

            if (properties.length > 0){
                properties.forEach((property) => {
                    let component = `<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="/properties/${property['id']}"><img class="img-fluid" src="http://127.0.0.1:8000/assets/theme/img/${property['image']}.jpg" alt="${property['image']}"></a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">${property['type']}</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">${property['category']}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">$${property['price']}</h5>
                                            <a class="d-block h5 mb-2" href="">${property['title']}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>${property['address']}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>${property['area']}m²</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>${property['rooms']}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>${property['bathrooms']}</small>
                                        </div>
                                    </div>
                                </div>`

                    components += component;
                });
            }
            else {
                components += '<h3 class="text-center wow fadeInUp">There are no available properties for the given filters.</h3>'
            }

            propertiesWrapper.html(components);
        }
    </script>
@endsection

