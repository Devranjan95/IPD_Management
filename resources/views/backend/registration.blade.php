@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            
                        </div>
                    </div>
                </div>

                <!-- =================================================== -->
                <!-- ========== tables-wrapper start ========== -->
                <div class="card mb-30">
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='row pb-2'>
                                    <div class='col-lg-6'>
                                        <h3 class="headingcolor">Registration</h3>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card mb-30">
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class='row pb-2'>
                    <div class='col-lg-6'>
                        <h3 class="headingcolor">Registration</h3>
                    </div>
                </div>
            </div>
            <div class='col-lg-12'>
                @php 
                $colors = [
                    'rgb(240,248,255)', // White
                    'rgba(245, 245, 245)', // White Smoke
                    ' rgb(255,255,240)', // Gainsboro
                    'rgba(255, 250, 250)', // Snow
                    'rgb(240,255,240)',  // Ghost White
                    'rgb(255,240,245,0.7)'
                ]; 
                @endphp
                <div class='col-lg-12'>
                    @foreach($floorOccupancy as $index => $occupancy)
                        <div class="row pt-3">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{ $index }}">
                                        <button class="accordion-button collapsed justify-content-center" style="background:{{ $colors[$index % count($colors)] }}; color: black;" type="button" data-bs-toggle="collapse" data-bs-target="#acc{{ $index }}" aria-expanded="false" aria-controls="acc{{ $index }}">
                                            {{$occupancy['floor_no']}} 
                                            <div style="padding-left:50px">
                                                @if($occupancy['total_available_cabin'] > 0)
                                                    <label class="badge badge-success">Cabin-beds: {{$occupancy['total_available_cabin']}}</label>
                                                @else
                                                    <label class="badge badge-danger">No cabins</label>
                                                @endif
                                                
                                                @if($occupancy['total_available_ward'] > 0)
                                                    <label class="badge badge-info">Ward-beds: {{$occupancy['total_available_ward']}}</label>
                                                @else
                                                    <label class="badge badge-danger">No wards</label>
                                                @endif
                                                
                                                @if($occupancy['total_available_icu'] > 0)
                                                    <label class="badge badge-primary">ICU-beds: {{$occupancy['total_available_icu']}}</label>
                                                @else
                                                    <label class="badge badge-danger">No ICUs</label>
                                                @endif
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="acc{{ $index }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $index }}">
                                        <div class="accordion-body">
                                            <div class="row">
                                                @foreach($occupancy['blockinfo'] as $blockIndex => $block)
                                                    <div class="col-md-4">
                                                        <div class="card mb-3" style="background:rgb(248,244,255); height: 300px; overflow-y: auto;">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{$block->block_name}}</h5>
                                                                <div class="card-text">
                                                                    @if(isset($occupancy['bedno'][$blockIndex]) && count($occupancy['bedno'][$blockIndex]) > 0)
                                                                        <div class="row">
                                                                            @foreach($occupancy['bedno'][$blockIndex] as $bedIndex => $bed)
                                                                                <div class="col-md-3">
                                                                                    <div class="form-check">
                                                                                        <!-- <input class="form-check-input" type="checkbox" id="bed{{$blockIndex}}{{$bedIndex}}" value="{{$bed->bed_no}}"> -->
                                                                                        <label class="form-check-label" for="bed{{$blockIndex}}{{$bedIndex}}">
                                                                                            <a href="#">
                                                                                                <i class="fa fa-bed" style="color:
                                                                                                    @if($bed->type == 'cabin')
                                                                                                        var(--bs-success);
                                                                                                    @elseif($bed->type == 'ward')
                                                                                                        var(--bs-info);
                                                                                                    @elseif($bed->type == 'icu')
                                                                                                        var(--bs-primary);
                                                                                                    @else
                                                                                                        green
                                                                                                    @endif;
                                                                                                    font-size:20px"></i>
                                                                                            </a>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                @if(($bedIndex + 1) % 4 == 0)
                                                                                    </div><div class="row">
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        No beds assigned.
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- end col -->
    </div>
    <!-- ========== tables-wrapper end ========== -->
</div>





                        </div>
                        <!-- end col -->
                    </div>
                    <!-- ========== tables-wrapper end ========== -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

@endsection