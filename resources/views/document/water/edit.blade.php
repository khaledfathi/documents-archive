@extends('layout.main')
@section('title', 'Edit Water Doc')
@section('links', '')
@section('scripts')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
@section('sectionName', 'Edit Water Bill ')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Documents</li>
        <li class="breadcrumb-item active"><a href="{{ route('document.electricity.index') }}">Water Bill</a></li>
        <li class="breadcrumb-item active">Edit Bill</li>
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
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Edit Electricity Bill</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('document.water.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$record->id}}">
            <div class="card-body d-flex flex-wrap">
                <div class="form-group col-md-6">
                    <label for="relaseDate">Relase Date</label>
                    <input type="date" class="form-control" placeholder="Relase Date" name="release_date" required value="{{$record->release_date}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="relaseDate">Counsumption KW/H</label>
                    <input type="number" class="form-control" placeholder="Consumption" min=1 name="consumption" required value="{{$record->consumption}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="relaseDate">Amount EGP</label>
                    <input type="number" class="form-control" placeholder="Amount" min=1 name="amount" required value="{{$record->amount}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Bill Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image" >
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>

                {{-- months checkboxes --}}
                <div class="form-group col-md-6">
                    <label>Month</label>
                    <select class="form-control" name="month" required>
                        @foreach (MONTHS as $month)
                            @if ($record->month == $loop->index+1)
                                <option selected value="{{ $loop->index+1}}">{{ $month }}</option>
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
                        value="{{ $record->year }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Notes</label>
                    <textarea class="form-control w-100 h-100" style="resize:none;" placeholder="Notes" name="notes">{{$record->notes}}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer col-12">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{route('document.water.index').'?year='.$record->year}}" class="btn btn-danger">Cancle</a>
            </div>
        </form>
    </div>
@endsection
