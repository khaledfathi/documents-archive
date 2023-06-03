@extends('layout.main')
@section('title', 'Create Electricity Doc')
@section('links', '')
@section('scripts')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
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
                - {{ $error }} <br>
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
                <div class="form-group col-md-6">
                    <label for="relaseDate">Relase Date</label>
                    <input type="date" class="form-control" placeholder="Relase Date" name="release_date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="relaseDate">Counsumption KW/H</label>
                    <input type="number" class="form-control" placeholder="Consumption" min=1 name="consumption" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="relaseDate">Amount EGP</label>
                    <input type="number" class="form-control" placeholder="Amount" min=1 name="amount" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Bill Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>

                {{-- months checkboxes --}}
                <div class="form-group col-md-6">
                    <label>Month</label>
                    <select class="form-control" name="month" required>
                        @foreach (MONTHS as $month)
                            @if (CURRENT_MONTH == $loop->index + 1)
                                <option selected value="{{ $loop->index + 1 }}">{{ $month }}</option>
                            @else
                                <option value="{{ $loop->index + 1 }}">{{ $month }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- / months checkboxes --}}

                <div class="form-group col-md-6">
                    <label for="relaseDate">year</label>
                    <input type="number" class="form-control" placeholder="Year" min=1900 name="year"
                        value="{{ CURRENT_YEAR }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Notes</label>
                    <textarea class="form-control w-100 h-100" style="resize:none;" placeholder="Notes" name="notes"></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('document.electricity.index').'?year='.CURRENT_YEAR }}" class="btn btn-danger">Cancle</a>
            </div>
        </form>
    </div>
@endsection
