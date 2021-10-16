@extends('components.admin.layouts.main')


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">資料列表</h6>
            </div>
            <div class="card-body overflow-auto">
                {{-- <form method="GET" class="form-inline mr-auto my-2 mw-100 navbar-search">
                    <div class="input-group">
                        <input value="{{ request()->page_url ?? '' }}" name="page_url" type="text" class="form-control bg-light border-0 small" placeholder="Search for v page" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>user_id</th>
                            <th>cate_name</th>
                            <th>faq_order</th>
                            <th>faq_status</th>
                            <th>faq_title</th>
                            <th>created</th>
                            <th>updated</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vFaqs as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td class="text-xs">
                                <a href="{{ route('admin.user.show', $item->user_id) }}" target="_blank">{{ $item->user_id }}</a>
                            </td>
                            <td>{{ $item->VCategory->cate_name ?? '無分類'}}</td>
                            <td>{{ $item->faq_order }}</td>
                            <td>{{ $item->faq_status }}</td>
                            <td>{{ $item->faq_title }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.vFaq.edit', $item->id) }}" target="_blank">edit</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
