@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <!-- =================================================== -->
                <!-- ========== tables-wrapper start ========== -->
                <div class="card mb-30">
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='row pb-2'>
                                    <div class='col-lg-6'>
                                        <h3 class="headingcolor">Masters</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Floors Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('floors')}}" class="card-link">
                                                <div class="card-body text-center">
                                                    <img src="{{asset('assets/master/stairs.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Floors</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Blocks Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('blocks')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/blocks.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Blocks</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Amenities Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('amenities')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/amenity.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Amenities</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Cabin-Types Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('cabintypes')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/cabintype.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Cabin-Types</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Ward-Types Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('wardtypes')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/wardtype.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Ward-Types</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- ICU-Types Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('icutypes')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/icutype.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">ICU-Types</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Cabins Card -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('cabins')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/cabins.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Cabins</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('wards')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/wards.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Wards</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('icus')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/icu.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">ICU's</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="card h-100 transition shadow">
                                            <a href="{{url('icus')}}" class="card-link">
                                                <div class="card-body text-center">
                                                <img src="{{asset('assets/master/icu.svg')}}" alt="">
                                                    <h5 class="card-title mt-3">Beds</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }
        .card.transition {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card.transition:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card.shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            border: none;
        }
        .card-body {
            padding: 20px;
        }
        .card h5 {
            margin-top: 10px;
        }
    </style>
@endsection
