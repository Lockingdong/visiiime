@extends('components.dashboard.layouts.main')


@section('content')
    <div id="app" class="container mx-auto pt-10 px-4 max-w-3xl">
        <h2 class="my-4 text-4xl font-bold card-title">訂閱紀錄</h2>
        <div class="my-4 text-lg font-medium">訂單</div>
        @foreach ($allSubscriptions as $item)
        <div @click="fetchSubRecordsByMerOrderNo('@php echo $item->mer_order_no @endphp')" class="collapse w-full border rounded-box border-base-300 collapse-arrow bg-white">
            <input type="checkbox">
            <div class="collapse-title text-sm font-medium">
                <div class="flex justify-between items-center h-full w-4/5">
                    <span>{{ $item->created_at->format('Y/m/d') }} 
                        @if ($item->us_sub_status === \App\Models\VUserSubscription::US_SUB_SUCCESS)
                        <br> <span class="text-xs">下期扣款日: {{ $item->nextAuthAt() }}</span>
                        @endif
                    </span>
                    <span>{{ $item->us_name }}</span>
                    <span>{{ $item->us_amount }}元/{{ $item->us_period }}天</span>
                    <span>{{ $item->subStatus() }}</span>
                </div>
            </div>
            <div class="collapse-content">
                {{-- <p>Collapse content reveals with focus. If you add a checkbox, you can control it using checkbox instead of
                    focus. Or you can force-open/force-close using
                    <span class="badge badge-outline">collapse-open</span> and
                    <span class="badge badge-outline">collapse-close</span> classes.
                </p> --}}
                <div class="text-sm">
                    <div v-for="item in subList['@php echo $item->mer_order_no @endphp']" class="flex justify-between w-4/5">
                        <span>@{{ item.created_at }}</span>
                        <span>@{{ item.us_name }}</span>
                        <span>@{{ item.us_amount }}元/@{{ item.us_period }}天</span>
                        <span>@{{ item.us_pay_status }}</span>
                    </div>
                </div>
                @if ($item->us_sub_status !== 'TERM')
                <form @submit="checkForm" method="POST" action="{{ route('subscription.terminate') }}" class="justify-center space-x-2 card-actions">
                    @csrf
                    <input type="hidden" name="mer_order_no" value="{{ $item->mer_order_no }}">
                    <button class="btn btn-sm bg-gray-500">取消訂閱</button> 
                </form>
                @endif
            </div>
        </div>
        @endforeach

        <div class="mt-2">
            {{ $allSubscriptions->links() }}
        </div>

        @if ($showResubArea)
            <h2 class="my-4 text-4xl font-bold card-title">重新訂閱</h2>

            @if ($latestNoAuthRecord !== null && $latestNoAuthRecord->us_sub_status !== 'TERM')
            <div class="collapse w-full border rounded-box border-base-300 collapse-arrow bg-white">
                <input type="checkbox">
                <div class="collapse-title text-sm font-medium">
                    <div class="flex justify-between items-center h-full w-4/5">
                        <span>
                            建立時間: {{ $latestNoAuthRecord->created_at->format('Y/m/d') }} <br>
                            開始扣款日: {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $latestNoAuthRecord->us_start_at)->format('Y/m/d') }}
                        </span>
                        <span>{{ $latestNoAuthRecord->us_name }}</span>
                        <span>{{ $latestNoAuthRecord->us_amount }}元/{{ $latestNoAuthRecord->us_period }}天</span>
                        <span>{{ $latestNoAuthRecord->subStatus() }}</span>
                    </div>
                </div>
                <div class="collapse-content">
                    @if ($latestNoAuthRecord->us_sub_status !== 'TERM')
                    <form @submit="checkForm" method="POST" action="{{ route('subscription.terminate') }}" class="justify-center space-x-2 card-actions">
                        @csrf
                        <input type="hidden" name="mer_order_no" value="{{ $latestNoAuthRecord->mer_order_no }}">
                        <button class="btn btn-sm bg-gray-500">取消訂閱</button> 
                    </form>
                    @endif
                </div>
            </div>
            @else
            <div class="card shadow bg-white">
                <div class="card-body">
                    <a href="{{ route('pricing', ['d' => $periodStartDate->format('Y/m/d')]) }}" class="btn bg-primary">於 {{ $periodStartDate->format('Y/m/d') }} 重新訂閱</a> 
                </div>
            </div>
            @endif
        @endif
        

        
    
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
            @if ($latestRecord->us_sub_status === 'SUCC')
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

@section('script')
<script>
const subList = {};
@foreach($allSubscriptions as $item)
subList['@php echo $item->mer_order_no @endphp'] = [];
@endforeach
</script>
<script>

const app = new Vue({
    el: '#app',
    data() {
        return {
            subList,
        }
    },
    methods: {
        fetchSubRecordsByMerOrderNo(mno) {
            if(this.subList[mno].length !== 0) {
                return;
            }
            axios.get('/api/v1/v-sub-records/' + mno)
                .then(rs => {
                    subList[mno] = rs.data.data.subRecords
                    // console.log(rs.data)
                }).catch(err => {

                    alert('發生錯誤, 請聯繫客服人員')
                })

        },
        checkForm(e) {
            let yes = confirm('確定要取消訂閱嗎');
            if (yes) {
                return true
            }

            e.preventDefault();
        }
    }
});

</script>    
@endsection
