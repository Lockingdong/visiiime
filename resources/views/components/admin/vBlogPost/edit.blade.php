@extends('components.admin.layouts.main')


@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">v post</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        @if (request()->is('*edit*'))
                        <div class="form-group">
                            <label for="banner">banner</label>
                            <input accept="image/png, image/jpeg, image/jpg" type="file" class="form-control-file" id="banner" name="post_banner">
                        </div>
                            @if ($vBlogPost->post_banner !== null)
                                <img class="w-50" src="{{ url('/') . $vBlogPost->post_banner }}" alt="">
                            @endif
                        @endif
                        <div class="form-group">
                            <label for="post_title">title</label>
                            <input value="{{ $vBlogPost->post_title ?? old('post_title') }}" type="text" class="form-control" id="post_title" name="post_title">
                        </div>
                        <div class="form-group">
                            <label for="post_content">content</label>
                            <textarea type="text" class="form-control" id="post_content" name="post_content">{{ $vBlogPost->post_content ?? old('post_content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="post_order">順序</label>
                            <input value="{{ $vBlogPost->post_order ?? old('post_order') }}" type="number" class="form-control" id="post_order" name="post_order">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">分類</label>
                            <select name="cate_id" class="custom-select">
                                <option value="" @if($vBlogPost->cate_id === null) selected @endif>無分類</option>
                                @foreach ($vBlogCategories as $cate)
                                <option value="{{ $cate->id }}" @if($vBlogPost->cate_id === $cate->id) selected @endif>{{ $cate->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">狀態</label>
                            <select name="post_status" class="custom-select">
                                @foreach ($status as $item)
                                <option value="{{ $item }}" @if($vBlogPost->post_status === $item) selected @endif>{{ $item }}</option>
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
