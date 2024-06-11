@extends('masterlayout.masterlayout')

@section('content')
<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- Title Wrapper Start -->
        <div class="container-wrapper pt-30">
            <!-- Card Start -->
            <div class="card mb-30 shadow-sm border-0">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h3 class="headingcolor">Bed Assign Form</h3>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                    <li class="breadcrumb-item text-secondary"><a href="{{url('beds')}}">Beds</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Bed Assign</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-3 floor-list">
                            <!-- Add tabs for Cabin, Ward, and ICU -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="cabin-tab" data-toggle="tab" href="#cabin" role="tab" aria-controls="cabin" aria-selected="true">Cabin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ward-tab" data-toggle="tab" href="#ward" role="tab" aria-controls="ward" aria-selected="false">Ward</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="icu-tab" data-toggle="tab" href="#icu" role="tab" aria-controls="icu" aria-selected="false">ICU</a>
                                </li>
                            </ul>
                            <!-- End of tabs -->
                            <div class="tab-content" id="myTabContent">
                                <!-- Tab content for Cabin -->
                                <div class="tab-pane fade show active" id="cabin" role="tabpanel" aria-labelledby="cabin-tab">
                                    @foreach($floors as $key => $value)
                                        <div class="floor-card mb-3" data-floor="{{ $value }}">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $value }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End of tab content for Cabin -->
                                <!-- Tab content for Ward -->
                                <div class="tab-pane fade" id="ward" role="tabpanel" aria-labelledby="ward-tab">
                                    <!-- Content for Ward tab -->
                                </div>
                                <!-- End of tab content for Ward -->
                                <!-- Tab content for ICU -->
                                <div class="tab-pane fade" id="icu" role="tabpanel" aria-labelledby="icu-tab">
                                    <!-- Content for ICU tab -->
                                </div>
                                <!-- End of tab content for ICU -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle tab switching
    $('#myTab a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Handle floor selection for Cabin tab
    $('.floor-card').on('click', function() {
        var floor = $(this).data('floor');
        $('#cabin .floor-card').removeClass('selected-floor');
        $(this).addClass('selected-floor');
        // Assuming you have an endpoint to fetch the number of available cabins
        $.ajax({
            type: "POST",
            url: "{{ url('getAvailableCabins') }}",
            data: { floor: floor },
            success: function(response) {
                // Display the number of available cabins
                $('#cabin').html('<p>Available Cabins: ' + response.availableCabins + '</p>');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error fetching data');
            }
        });
    });
});
</script>
<style>
.floor-list {
    max-height: 400px;
    overflow-y: auto;
}
</style>
@endsection
