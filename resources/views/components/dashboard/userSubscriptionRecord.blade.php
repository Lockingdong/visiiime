@extends('components.dashboard.layouts.main')


@section('content')
<div class="container mx-auto pt-10 px-4 max-w-3xl">
    <h2 class="my-4 text-4xl font-bold card-title">訂閱紀錄</h2>
    {{-- <div class="card shadow">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>扣款時間</th>
                        <th>訂閱項目</th>
                        <th>付款狀態</th>
                        <th>金額</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($histRecords as $item)
                    <tr>
                        <th>
                            {{ $item->created_at->format('Y-m-d') }}
                        </th>
                        <td>
                            {{ $item->us_name }}
                        </td>
                        <td>
                            {{ $item->us_pay_status }}
                        </td>
                        <td>
                            {{ $item->us_amount }} TWD / <span class="text-sm">{{ $item->us_period }}day</span>   
                        </td>
                    </tr>
                    @endforeach
                    
                    @if ($latestRecord !== null)
                    <tr>
                        <th>
                            {{ $latestRecord->created_at->format('Y-m-d') }}
                        </th>
                        <td>
                            {{ $latestRecord->us_name }}
                        </td>
                        <td>
                            {{ $latestRecord->us_pay_status }}
                        </td>
                        <td>
                            {{ $latestRecord->us_amount }} TWD / <span class="text-sm">{{ $latestRecord->us_period }}day</span>   
                        </td>
                    </tr>
                    @endif
                    
                    
                </tbody>
            </table>
        </div>

    </div>

    @if ($latestRecord !== null)
    <h2 class="my-4 text-4xl font-bold card-title">目前訂閱內容</h2>
    <div class="card shadow bg-white">
        <div class="card-body">
            <p>訂閱名稱: {{ $latestRecord->us_name }}</p>
            <p>信用卡卡號: {{ $latestRecord->us_card_num ?? '尚未授權成功，無法顯示卡號' }} <span class="text-sm">(欲更換卡號請先取消訂閱再重新訂閱)</span></p>
            <p>訂閱到期日: {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $latestRecord->us_end_at)->format('Y-m-d') }}</p>
            <p>下次扣款日: {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $latestRecord->us_next_auth_at)->format('Y-m-d') }}</p>
            <p>訂閱狀態: {{ $latestRecord->us_sub_status }}</p>
            <hr class="my-2">
            @if($latestRecord->us_sub_status === 'SUCC')
            <form method="POST" action="{{ route('subscription.terminate') }}" class="justify-end space-x-2 card-actions">
                @csrf
                <button class="btn bg-gray-500">修改信用卡</button> 
                <input type="hidden" name="id" value="{{ $latestRecord->id }}">
                <button class="btn bg-gray-500">取消訂閱</button> 
            </form>
            @else
            <form method="POST" action="{{ route('subscription.pay') }}" class="justify-end space-x-2 card-actions">
                @csrf
                <input type="hidden" name="id" value="{{ $latestRecord->id }}">
                <input type="hidden" name="type" value="month">
                <input type="hidden" name="period_start_date" value="{{ $periodStartDate }}">
                <button class="btn bg-primary">重新訂閱</button> 
            </form>
            @endif
        </div>

    </div>
    @endif --}}
</div>
        
@endsection