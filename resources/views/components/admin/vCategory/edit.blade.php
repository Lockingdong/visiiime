@extends('components.admin.layouts.main')


@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">v category</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">category type</label>
                            <select name="cate_type" class="custom-select">
                                @foreach ($cate_types as $item)
                                    <option value="{{ $item }}" @if($vCategory->cate_type === $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cate_name">cate name</label>
                            <input value="{{ $vCategory->cate_name ?? old('cate_name') }}" type="text" class="form-control" id="cate_name" name="cate_name">
                        </div>
                        <div class="form-group">
                            <label for="cate_order">順序</label>
                            <input value="{{ $vCategory->cate_order ?? old('cate_order') }}" type="number" class="form-control" id="cate_order" name="cate_order">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">狀態</label>
                            <select name="cate_status" class="custom-select">
                                @foreach ($status as $item)
                                <option value="{{ $item }}" @if($vCategory->cate_status === $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script
        src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.js">
    </script>
    <script>

    </script>
@endsection
