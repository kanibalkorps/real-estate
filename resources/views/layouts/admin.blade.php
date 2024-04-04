<!doctype html>
<html lang="en">
    @include("fixed.admin.head")
    <body>
        @include("fixed.admin.header")
        @include("fixed.admin.sidebar")
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            @yield("content")
        </div>
        @include("fixed.admin.scripts")
    </body>
</html>
