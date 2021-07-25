@extends('components.admin.layouts.main')


@section('content')
<div class="row">

    <div class="col-12">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">v page</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{$action}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput">更改狀態</label>
                        <select name="status" class="custom-select">
                            @foreach ($status as $item)
                            <option value="{{ $item }}" @if($vPage->page_status === $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">送出</button>
                    </div>
                </form>
                <pre id="v-page"></pre>
                <h6> social links</h6>
                <pre id="social-link"></pre>
                <h6> custom data</h6>
                <pre id="custom-data"></pre>

            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.js"></script>
<script>

const vPage = @json($vPage);
$('#v-page').json_viewer(vPage);
$('#social-link').json_viewer(JSON.parse(vPage.social_links));
$('#custom-data').json_viewer(JSON.parse(vPage.custom_data));

</script>

@endsection
