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
                            <th>cate_type</th>
                            <th>cate_name</th>
                            <th>post_order</th>
                            <th>post_status</th>
                            <th>post_title</th>
                            <th>created</th>
                            <th>updated</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vPosts as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td class="text-xs">
                                <a href="{{ route('admin.user.show', $item->user_id) }}" target="_blank">{{ $item->user_id }}</a>
                            </td>
                            <th>{{ $item->category->cate_type }}</th>
                            <td>{{ $item->category->cate_name }}</td>
                            <td>{{ $item->post_order }}</td>
                            <td>{{ $item->post_status }}</td>
                            <td>{{ $item->post_title }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            @if ($item->category->cate_type === 'POST')
                            <td>
                                <a href="{{ route('admin.vPost.edit', $item->id) }}" target="_blank">edit</a>
                            </td>
                            @else
                            <td>
                                <a href="{{ route('admin.vFaq.edit', $item->id) }}" target="_blank">edit</a>
                            </td>
                                
                            @endif
                            
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
