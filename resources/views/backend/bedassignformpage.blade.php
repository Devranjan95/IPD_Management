@extends('masterlayout.masterlayout')

@section('content')
<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- Title Wrapper Start -->
        <div class="container-wrapper pt-4">
            <!-- Card Start -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h3 class="headingcolor">Bed Assign Form</h3>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('masters') }}" class="text-decoration-none text-secondary">Masters</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('beds') }}" class="text-decoration-none text-secondary">Beds</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('bedassignvisual') }}" class="text-decoration-none text-primary">Bed Assign</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Bed Assign</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- Bed Assign Form Start -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="accordion" id="bedAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingBeds">
                                        <button class="accordion-button custom-header bg-info text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBeds" aria-expanded="true" aria-controls="collapseBeds">
                                         -> Click here to see bed information
                                        </button>
                                    </h2>
                                    <div id="collapseBeds" class="accordion-collapse collapse" aria-labelledby="headingBeds" data-bs-parent="#bedAccordion">
                                        <div class="accordion-body" style="background:rgb(0,139,139,0.8);color:#fff">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-info">
                                                        <tr>
                                                            <th>Bed Name</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Available</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($beds as $bed)
                                                        @php 
                                                        $available = ($bed->no_of_beds) - ($bed->assigned_no)
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $bed->bed_name }}</td>
                                                            <td>
                                                                <span class="badge {{ $bed->status == 'Active' ? 'badge-success' : 'badge-danger' }}">{{ $bed->status }}</span>
                                                            </td>
                                                            <td>{{ $bed->no_of_beds }}</td>
                                                            <td>{{ $available }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="accordion" id="infoAccordion">
                                @if(isset($cabininfo))
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingCabin">
                                            <button class="accordion-button custom-header bg-success text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCabin" aria-expanded="true" aria-controls="collapseCabin">
                                               -> Click here to see {{$cabininfo->cabin_name}} -> cabin information
                                            </button>
                                        </h2>
                                        <div id="collapseCabin" class="accordion-collapse collapse" aria-labelledby="headingCabin" data-bs-parent="#infoAccordion">
                                            <div class="accordion-body" style="background:rgb(60,179,113,0.8)">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Cabin Type:</th>
                                                            <td>{{ $cabininfo->cabintype->cabin_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Block:</th>
                                                            <td>{{ $cabininfo->block->block_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Floor:</th>
                                                            <td>{{ $cabininfo->floor->floor_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Total Occupancy</th>
                                                            <td>{{ $cabininfo->total_occupancy }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php 
                                                            $available = ($cabininfo->total_occupancy) - ($cabininfo->assigned)
                                                            @endphp
                                                            <th scope="row">Available</th>
                                                            <td>{{ $available }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(isset($wardinfo))
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingWard">
                                            <button class="accordion-button custom-header bg-success text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWard" aria-expanded="true" aria-controls="collapseWard">
                                            -> Click here to see {{$wardinfo->ward_name}} ward information
                                            </button>
                                        </h2>
                                        <div id="collapseWard" class="accordion-collapse collapse" aria-labelledby="headingWard" data-bs-parent="#infoAccordion">
                                            <div class="accordion-body" style="background:rgb(60,179,113,0.8)">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Ward Type:</th>
                                                            <td>{{ $wardinfo->wardtype->ward_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Block:</th>
                                                            <td>{{ $wardinfo->block->block_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Floor:</th>
                                                            <td>{{ $wardinfo->floor->floor_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Total Occupancy</th>
                                                            <td>{{ $wardinfo->total_occupancy }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php 
                                                            $available = ($wardinfo->total_occupancy) - ($wardinfo->assigned)
                                                            @endphp
                                                            <th scope="row">Available</th>
                                                            <td>{{ $available }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(isset($icuinfo))
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingIcu">
                                            <button class="accordion-button custom-header bg-success text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIcu" aria-expanded="true" aria-controls="collapseIcu">
                                            -> Click here to see {{$icuinfo->icu_name}} ICU information
                                            </button>
                                        </h2>
                                        <div id="collapseIcu" class="accordion-collapse collapse" aria-labelledby="headingIcu" data-bs-parent="#infoAccordion">
                                            <div class="accordion-body" style="background:rgb(60,179,113,0.8)">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">ICU Type:</th>
                                                            <td>{{ $icuinfo->icutype->icu_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Block:</th>
                                                            <td>{{ $icuinfo->block->block_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Floor:</th>
                                                            <td>{{ $icuinfo->floor->floor_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Total Occupancy</th>
                                                            <td>{{ $icuinfo->total_occupancy }}</td>
                                                        </tr>
                                                        <tr>
                                                            @php 
                                                            $available = ($icuinfo->total_occupancy) - ($icuinfo->assigned)
                                                            @endphp
                                                            <th scope="row">Available</th>
                                                            <td>{{ $available }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Bed Assign Form Start -->
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body" style="background:rgb(253,255,245)">
                            <!-- <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <h4>Assign a bed</h4>
                                    <form>
                                        <div class="form-group">
                                            <label for="bed_name">Select Bed</label>
                                            <select class="form-control" id="bed_name" name="bed_name">
                                                @foreach($beds as $bed)
                                                    <option value="{{ $bed->id }}">{{ $bed->bed_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bed_numbers">Select Bed Number</label>
                                            <div id="bed_numbers" class="row">
                                                @if(isset($cabininfo))
                                                    @php
                                                        $prefix = $cabininfo->cabin_name."/".$cabininfo->block->block_name."/".$cabininfo->floor->floor_no."/";
                                                        $occu = $cabininfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @elseif(isset($wardinfo))
                                                    @php
                                                        $prefix = $wardinfo->ward_name."/".$wardinfo->block->block_name."/".$wardinfo->floor->floor_no."/";
                                                        $occu = $wardinfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @elseif(isset($icuinfo))
                                                    @php
                                                        $prefix = $icuinfo->icu_name."/".$icuinfo->block->block_name."/".$icuinfo->floor->floor_no."/";
                                                        $occu = $icuinfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-success" type="button">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Assigned Details</h4>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-6 mb-3" style="border-right: 1px solid #ccc;">
                                    <h4 class="pb-2">Assign a bed</h4>
                                    <form enctype="multipart/form-data" name="bedAssignForm" id="bedAssignForm">
                                        <div class="form-group">
                                            <label for="bed_name">Select Bed Name</label>
                                            <select class="form-control" id="bed_name" name="bed_name">
                                                @foreach($beds as $bed)
                                                    <option value="{{ $bed->bed_name }}">{{ $bed->bed_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bed_numbers">Select Bed Number</label>
                                            <div id="bed_numbers" class="row">
                                                @if(isset($cabininfo))
                                                            <input type="hidden" id="id" name="id" value="{{$cabininfo->id}}">
                                                            <input type="hidden" id="block" name="block" value="{{$cabininfo->block->id}}">
                                                            <input type="hidden" id="floor" name="floor" value="{{$cabininfo->floor->count}}">
                                                            <input type="hidden" id="flag" name="flag" value="cabin">
                                                    @php
                                                        $prefix = $cabininfo->cabin_name."/".$cabininfo->block->block_name."/".$cabininfo->floor->floor_no."/";
                                                        $occu = $cabininfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                            
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{$prefix}}{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @elseif(isset($wardinfo))
                                                            <input type="hidden" id="id" name="id" value="{{$wardinfo->id}}">
                                                            <input type="hidden" id="block" name="block" value="{{$wardinfo->block->id}}">
                                                            <input type="hidden" id="floor" name="floor" value="{{$wardinfo->floor->count}}">
                                                            <input type="hidden" id="flag" name="flag" value="ward">
                                                    @php
                                                        $prefix = $wardinfo->ward_name."/".$wardinfo->block->block_name."/".$wardinfo->floor->floor_no."/";
                                                        $occu = $wardinfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{$prefix}}{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @elseif(isset($icuinfo))
                                                            <input type="hidden" id="id" name="id" value="{{$icuinfo->id}}">
                                                            <input type="hidden" id="block" name="block" value="{{$icuinfo->block->id}}">
                                                            <input type="hidden" id="floor" name="floor" value="{{$icuinfo->floor->count}}">
                                                            <input type="hidden" id="flag" name="flag" value="icu">
                                                    @php
                                                        $prefix = $icuinfo->icu_name."/".$icuinfo->block->block_name."/".$icuinfo->floor->floor_no."/";
                                                        $occu = $icuinfo->total_occupancy;
                                                    @endphp
                                                    @for($i = 1; $i <= $occu; $i++)
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="bed_numbers[]" value="{{$prefix}}{{ $i }}" id="bedNumber{{ $i }}">
                                                                <label class="form-check-label" for="bedNumber{{ $i }}">
                                                                    {{$prefix}} {{ $i }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                            <div class="d-grid gap-2 pt-3">
                                                <button type="submit" class="btn btn-success" type="button">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <h4>Assigned Details</h4>
                                    @if(isset($bedassigned))
                                        @foreach($bedassigned as $assigned)
                                            {{$assigned->bed_name}}
                                            <div class="col-lg-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bed_numbers_assigned[]" value="{{$assigned->bed_no }}" id="bedNumberassign{{ $i }}">
                                                    <label class="form-check-label" for="bedNumber{{ $assigned->bed_no }}">
                                                        {{$assigned->bed_no}}  
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Bed Assign Form End -->

                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- Bootstrap JS and dependencies -->

<script>
$(document).on('submit', '#bedAssignForm', function(event) {
    event.preventDefault();
    let formdata = new FormData(document.getElementById('bedAssignForm'));
    formdata.append('_token','{{csrf_token()}}');

    // Log the form data for debugging
    for (let pair of formdata.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    
    $.ajax({
        type: "POST",
        url: "{{url('bedassign/assign')}}",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message);
            console.log(response.message);
        },
        error: function(response) {
            console.error('An error occurred while assigning the bed:', response);
            alert('An error occurred while assigning the bed. Please try again.');
        }
    });
});
</script>
@endsection
