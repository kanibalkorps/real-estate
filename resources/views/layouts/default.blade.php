<!DOCTYPE html>
<html lang="en">
    @include("fixed.head")
    <body>
        <div class="container-fluid mx-0 w-100 bg-white p-0">
            @include("fixed.header")
            @yield("content")
            @include("fixed.footer")
        </div>
        @include("fixed.scripts")
    </body>
</html>
