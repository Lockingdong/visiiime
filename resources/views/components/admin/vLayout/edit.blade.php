@extends('components.admin.layouts.main')

@section('style')
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/visual-json-editor-jsonedtr/JSONedtr.css">
    
@endsection


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
                            <label for="theme_name">theme name</label>
                            <input value="{{ $vLayout->theme_name }}" readonly type="text" class="form-control" id="theme_name" name="theme_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_role">layout role(限定 VIP, VVIP)</label>
                            <input value="{{ $vLayout->layout_role ?? old('layout_role') }}" type="text" class="form-control" id="layout_role" name="layout_role">
                        </div>
                        <div class="form-group">
                            <label for="layout_bg_name">layout bg name(限定 bgPlain, bgGradient, bgImage)</label>
                            <input value="{{ $vLayout->layout_bg_name ?? old('layout_bg_name') }}" type="text" class="form-control" id="layout_bg_name" name="layout_bg_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_display_name">display name</label>
                            <input value="{{ $vLayout->layout_display_name ?? old('layout_display_name') }}" type="text" class="form-control" id="layout_display_name" name="layout_display_name">
                        </div>
                        <div class="form-group">
                            <label for="layout_code">code</label>
                            <input value="{{ $vLayout->layout_code ?? old('layout_code') }}" type="text" class="form-control" id="layout_code" name="layout_code">
                        </div>
                        {{-- <div class="form-group">
                            <label for="layout_code">image url</label>
                            <input value="{{ $vLayout->layout_image ?? old('layout_image') }}" type="text" class="form-control" id="layout_image" name="layout_image">
                        </div> --}}
                        <div class="form-group">
                            <label for="layout_order">順序</label>
                            <input value="{{ $vLayout->layout_order ?? old('layout_order') }}" type="number" class="form-control" id="layout_order" name="layout_order">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">狀態</label>
                            <select class="custom-select" name="layout_status">
                                @foreach ($status as $item)
                                <option value="{{ $item }}" @if($vLayout->layout_status === $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="layout_setting">layout setting</label>
                            <input value="{{ $vLayout->layout_setting ?? old('layout_setting') }}" type="text" class="form-control" id="layout_setting" name="layout_setting">
                        </div>
                        <div class="form-group" id="output"></div>
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
<script src="https://www.jqueryscript.net/demo/visual-json-editor-jsonedtr/JSONedtr.js"></script>
<script>

const vLayout = @json($vLayout);
var customData = vLayout.layout_setting;

if(customData === undefined) {
    customData = '{"text": {"textColor": "#666666"}, "support": {"display": true}, "background": {"bgName": "bgGradient", "bgType": "background", "bgColor": "#ffffff", "bgImage": "", "bgColor2": "#666666", "customBgOn": true}, "linkButton": {"buttonName": "", "buttonBorder": "no-border", "buttonRadius": "sm-bdrs", "buttonBgColor": "#333333", "buttonTextColor": "#fafafa"}}';
    $('#layout_setting').val(customData)
}


function getDataOnChange( data ){
  $('#layout_setting').val(JSON.stringify(data.getData()))
}

new JSONedtr(customData, '#output', {
    runFunctionOnUpdate:'getDataOnChange', 
    instantChange: true
});


</script>

@endsection