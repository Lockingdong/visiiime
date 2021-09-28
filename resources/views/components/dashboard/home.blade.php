@extends('components.dashboard.layouts.main')

@section('content')

    <div class="container mx-auto pt-10 px-4">
        <div class="card shadow">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>預設</th>
                            <th>連結名稱</th>
                            <th>建立時間</th>
                            <th>狀態</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pageList as $page)
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox">
                                </label>
                            </th>
                            <td>
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <div class="font-bold">
                                            {{ $page->page_url }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $page->created_at }}
                            </td>
                            <td>
                                {{ $page->page_status }}
                            </td>
                            <th>
                                <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}" class="btn btn-xs">編輯</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>




@endsection
