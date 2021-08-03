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
                        <input value="{{ request()->email ?? '' }}" name="page_url" type="text" class="form-control bg-light border-0 small" placeholder="email" aria-label="Search" aria-describedby="basic-addon2">
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
                            <th>email</th>
                            <th>provider</th>
                            <th>user_status</th>
                            <th>role</th>
                            <th>edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <th class="text-xs">{{ $item->id }}</th>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->provider }}</td>
                            <td>{{ $item->user_status }}</td>
                            <td>{{ $item->role }}</td>
                            <td>
                                <a href="{{ route('admin.user.show', $item->id) }}" target="_blank">edit</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{$users->appends(request()->except('page'))->links()}}
        </div>
    </div>
</div>

@endsection
