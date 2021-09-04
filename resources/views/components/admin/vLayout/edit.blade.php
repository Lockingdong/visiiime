@extends('components.admin.layouts.main')


@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">v layout</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="theme_name">name</label>
                            <input value="{{ $vLayout->theme_name }}" readonly type="text" class="form-control" id="theme_name" name="theme_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_name">name</label>
                            <input value="{{ $vLayout->layout_name ?? old('layout_name') }}" type="text" class="form-control" id="layout_name" name="layout_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_display_name">display name</label>
                            <input value="{{ $vLayout->layout_display_name ?? old('layout_display_name') }}" type="text" class="form-control" id="layout_display_name" name="layout_display_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_code">code</label>
                            <input value="{{ $vLayout->layout_code ?? old('layout_code') }}" type="number" class="form-control" id="layout_code" name="layout_code">
                        </div>
                        <div class="form-group">
                            <label for="layout_code">image url</label>
                            <input value="{{ $vLayout->layout_image ?? old('layout_image') }}" type="text" class="form-control" id="layout_image" name="layout_image">
                        </div>
                        <div class="form-group">
                            <label for="layout_order">順序</label>
                            <input value="{{ $vLayout->layout_order ?? old('layout_order') }}" type="number" class="form-control" id="layout_order" name="layout_order">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">狀態</label>
                            <select class="custom-select">
                                @foreach ($status as $item)
                                <option value="{{ $item }}" @if($vLayout->layout_status === $item) selected @endif>{{ $item }}</option>
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
