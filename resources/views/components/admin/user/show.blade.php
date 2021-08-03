@extends('components.admin.layouts.main')


@section('content')
<div class="row">

    <div class="col-12">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">user</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{$action}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">更改狀態</label>
                        <select name="user_status" class="custom-select">
                            @foreach ($userStatus as $item)
                            <option value="{{ $item }}" @if($user->user_status === $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">角色</label>
                        <select name="role" class="custom-select">
                            @foreach ($roles as $item)
                            <option value="{{ $item }}" @if($user->role === $item) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" name="verify" class="custom-control-input" value="1"
                            @if($user->email_verified_at !== null) checked @endif
                        >
                        <label class="custom-control-label" for="customRadio1">人工認證</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" name="verify" class="custom-control-input" value="0"
                            @if($user->email_verified_at === null) checked @endif
                        >
                        <label class="custom-control-label" for="customRadio2">未認證</label>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">送出</button>
                    </div>
                </form>
                <pre id="user"></pre>
                {{-- <h6> social links</h6>
                <pre id="social-link"></pre>
                <h6> custom data</h6>
                <pre id="custom-data"></pre> --}}

            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.js"></script>
<script>

const user = @json($user);
$('#user').json_viewer(user);
// $('#social-link').json_viewer(JSON.parse(vPage.social_links));
// $('#custom-data').json_viewer(JSON.parse(vPage.custom_data));

</script>

@endsection
