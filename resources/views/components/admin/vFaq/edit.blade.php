@extends('components.admin.layouts.main')


@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">v faq</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="faq_title">title</label>
                            <input value="{{ $vFaq->faq_title ?? old('faq_title') }}" type="text" class="form-control"
                                   id="faq_title" name="faq_title">
                        </div>
                        <div class="form-group">
                            <label for="faq_content">content</label>
                            <textarea type="text" class="form-control" id="faq_content"
                                      name="faq_content">{{ $vFaq->faq_content ?? old('faq_content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="faq_order">順序</label>
                            <input value="{{ $vFaq->faq_order ?? old('faq_order') }}" type="number" class="form-control"
                                   id="faq_order" name="faq_order">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">分類</label>
                            <select name="cate_id" class="custom-select">
                                <option value="" @if($vFaq->cate_id === null) selected @endif>無分類</option>
                                @foreach ($vCategories as $cate)
                                    <option value="{{ $cate->id }}"
                                            @if($vFaq->cate_id === $cate->id) selected @endif>{{ $cate->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">狀態</label>
                            <select name="faq_status" class="custom-select">
                                @foreach ($status as $item)
                                    <option value="{{ $item }}"
                                            @if($vFaq->faq_status === $item) selected @endif>{{ $item }}</option>
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
    <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Easily-Readable-JSON-Data-Viewer/json-viewer/jquery.json-viewer.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        const editor = CKEDITOR.replace('faq_content');

        editor.on('fileUploadRequest', function (event) {
            let requestDataObject = event.data.requestData;
            requestDataObject['image'] = requestDataObject['upload'];

            delete requestDataObject['upload'];
        });
    </script>
@endsection
