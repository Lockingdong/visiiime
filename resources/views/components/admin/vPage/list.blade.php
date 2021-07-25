@extends('components.admin.layouts.main')


@section('content')
<div class="row">
    <div class="col-12">
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">資料列表</h6>
            </div>
            <div class="card-body overflow-auto">
                <form method="GET" class="form-inline mr-auto my-2 mw-100 navbar-search">
                    <div class="input-group">
                        <input value="{{ request()->page_id ?? '' }}" name="page_id" type="text" class="form-control bg-light border-0 small" placeholder="Search for v page" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>user_id</th>
                            <th>layout_code</th>
                            <th>page_status</th>
                            <th>page_url</th>
                            <th>online</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vPages as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td class="text-xs">{{ $item->user_id }}</td>
                            <td>{{ $item->layout_code }}</td>
                            <td>{{ $item->page_status }}</td>
                            <td>
                                <a href="{{ url($item->page_url) }}" target="_blank">{{ $item->page_url }}</a>
                            </td>
                            <td>{{ $item->online }}</td>
                            <td>
                                <a href="{{ route('admin.vPage.show', $item->id) }}" target="_blank">edit</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{$vPages->appends(request()->except('page'))->links()}}
        </div>
    </div>
</div>

@endsection
