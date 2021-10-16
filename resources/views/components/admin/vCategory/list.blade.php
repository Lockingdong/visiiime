@extends('components.admin.layouts.main')


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">資料列表</h6>
            </div>
            <div class="card-body overflow-auto">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>cate_order</th>
                            <th>cate_status</th>
                            <th>cate_name</th>
                            <th>created</th>
                            <th>updated</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vCategories as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td>{{ $item->model_name }}</td>
                            <td>{{ $item->cate_order }}</td>
                            <td>{{ $item->cate_status }}</td>
                            <td>{{ $item->cate_name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.vCategory.edit', $item->id) }}" target="_blank">edit</a>
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
