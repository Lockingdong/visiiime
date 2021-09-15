@extends('components.admin.layouts.main')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">資料列表</h6>
                </div>
                <div class="card-body overflow-auto">
                    <form
                        method="GET"
                        action="{{ route('admin.vFile.list')  }}"
                        class="form-inline mr-auto my-2 mw-100 navbar-search">
                        <div class="input-group">
                            <input
                                value="{{ request()->search ?? '' }}"
                                name="search"
                                type="text"
                                class="form-control bg-light border-0 small"
                                placeholder="Search for v page"
                                aria-label="Search"
                                aria-describedby="basic-addon2">
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
                            <th>model_id</th>
                            <th>model_name</th>
                            <th>field_name</th>
                            <th>file_type</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>image</th>
                            <th>delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vFiles as $item)
                            <tr>
                                <th class="text-xs">{{ $item->id }}</th>
                                <td>{{ $item->model_id }}</td>
                                <td>{{ $item->model_name }}</td>
                                <td>{{ $item->field_name }}</td>
                                <td>{{ $item->file_type }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <image src="{{ $item->file_path }}"></image>
                                </td>
                                <td>
                                    <form action={{ route('admin.vFile.destroy', $item->id) }} method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{ $vFiles->withQueryString()->links() }}
        </div>
    </div>

@endsection
