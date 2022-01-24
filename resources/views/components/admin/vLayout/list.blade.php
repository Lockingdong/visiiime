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
                            <th>layout_display_name</th>
                            <th>layout_bg_name</th>
                            <th>layout_code</th>
                            <th>layout_status</th>
                            <th>layout_order</th>
                            <th>效期</th>
                            <th>時間</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vLayouts as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td>{{ $item->layout_display_name }}</td>
                            <td>{{ $item->layout_bg_name }}</td>
                            <td>{{ $item->layout_code }}</td>
                            <td>{{ $item->layout_status }}</td>
                            <td>{{ $item->layout_order }}</td>
                            <td class="text-xs">{{ $item->start_at }}<br>{{ $item->end_at }}</td>
                            <td class="text-xs">{{ $item->created_at }}<br>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.vLayout.edit', $item->id) }}" target="_blank">edit</a>
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
