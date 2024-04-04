@extends("layouts.default")

@section("content")
    <h1 class="text-center my-4">About Author</h1>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="{{ asset("assets/img/DSC01092-cut.jpg") }}" alt="about author image"/>
            </div>
            <div class="col-lg-4">
                <ul>
                    <li>Student: Martin Birišić</li>
                    <li>Study Programme: Internet Technologies</li>
                    <li>Study Module: Web Programming</li>
                    <li>Course: Web Programming PHP 2 (Laravel)</li>
                    <li>Year: 3</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
