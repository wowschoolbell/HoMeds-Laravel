<div class="bg-white">
    <div class="container">
        <div class="row page-titles">
            <div class="col-md-5 m-auto">
                <h4 class="mb-0">@yield('title') </h4>
            </div>
            <div class="col-md-7 m-auto">
                <nav aria-label="breadcrumb" class="float-right">
                    {{ Breadcrumbs::render(\Request::route()->getName()) }}
                </nav>
            </div>
        </div>
    </div>
</div>
