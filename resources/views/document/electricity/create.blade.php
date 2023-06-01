@extends('layout.main')
@section('title', 'Create Electricity Doc')
@section('links', '')
@section('scripts')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/js/documents/electricity/create.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
@section('sectionName', 'New Electricity Bill ')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Documents</li>
        <li class="breadcrumb-item active"><a href="{{ route('document.electricity.index') }}">Electricity</a></li>
        <li class="breadcrumb-item active">New Bill</li>
    </ol>
@endsection


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            @foreach ($errors->all() as $error)
               - {{$error}} <br>
            @endforeach
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Store Electricity Bill</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('document.electricity.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body d-flex flex-wrap">
                <div class="form-group col-6">
                    <label for="relaseDate">Relase Date</label>
                    <input type="date" class="form-control" placeholder="Relase Date" name="release_date">
                </div>
                <div class="form-group col-6">
                    <label for="relaseDate">Counsumption KW/H</label>
                    <input type="number" class="form-control" placeholder="Consumption" min=1 name="consumption">
                </div>
                <div class="form-group col-6">
                    <label for="relaseDate">Amount EGP</label>
                    <input type="number" class="form-control" placeholder="Amount" min=1 name="amount">
                </div>
                <div class="form-group col-6">
                    <label for="relaseDate">year</label>
                    <input type="number" class="form-control" placeholder="Year" min=1900 name="year" value="{{$currentYear}}">
                </div>

                {{-- months checkboxes --}}
                <div class="form-group col-md-6 col-sm-12 ">
                    <label for="monthe ">Month/s</label>
                    <div class="d-flex flex-wrap" style="gap:10px" id="monthes-div">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m1" value="1">
                            <label class="form-check-label" for="m1">1-January</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m2" value=2>
                            <label class="form-check-label" for="m2">2-February</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m3" value=3>
                            <label class="form-check-label" for="m3">3-Mach</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m4" value=4>
                            <label class="form-check-label" for="m4">4-April</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m5" value=5>
                            <label class="form-check-label" for="m5">5-May</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m6" value=6>
                            <label class="form-check-label" for="m6">6-June</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m7" value=7>
                            <label class="form-check-label" for="m7">7-July</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m8" value=8>
                            <label class="form-check-label" for="m8">8-August</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m9" value=9>
                            <label class="form-check-label" for="m9">9-September</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m10" value=10>
                            <label class="form-check-label" for="m10">10-October</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m11" value=11>
                            <label class="form-check-label" for="m11">11-November</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="m12" value=12>
                            <label class="form-check-label" for="m12">12-December</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="monthes" id="selected-monthes" value="[]">
                {{-- / months checkboxes --}}
                <div class="form-group col-6">
                    <label for="exampleInputFile">Bill Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputFile">Notes</label>
                    <textarea class="form-control w-100 h-100" style="resize:none;" placeholder="Notes" name="notes"></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
