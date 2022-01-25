@extends('components.dashboard.layouts.main')

@section('content')

    <div class="container mx-auto pt-5 px-4 max-w-xl">
        <div class="card shadow">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>預設</th>
                            <th>連結名稱</th>
                            <th>狀態</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pageList as $page)
                            <tr>
                                <th>
                                    @if ($page->page_default === \App\Models\VPage::PAGE_DEFAULT_Y)
                                    <label>
                                        <input checked disabled type="checkbox" class="checkbox">
                                    </label>
                                    @endif
                                    
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
                                    @if ($page->page_status === \App\Models\VPage::AVAILABLE)
                                    <span class="text-sm">
                                        {{ $page->pageOnline() }}
                                    </span>
                                    @endif
                                </td>
                                <th>
                                    @if ($page->page_status === \App\Models\VPage::AVAILABLE)
                                    <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}"
                                        class="btn btn-xs">編輯</a>
                                    @else
                                        <span class="text-xs">無法使用</span>
                                        
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-5">
            <div class="justify-end">
                @if ($disableCreateLink)
                <button type="button" disabled="true" class="btn btn-primary w-full">頁面已達上限</button>
                @else
                <a href="{{ route('dashboard.vPageCreate') }}" class="btn btn-primary w-full">新增頁面</a>      
                @endif
            </div>
        </div>

        {{-- <div id="app" class="mt-5">
            <button @click="show" class="btn btn-primary w-full">新增頁面</button>
            <modal name="create-v-page" :max-width="600" width="90%" height="auto" :adaptive="true">
                <div class="card shadow-md p-3 bg-white relative">
                    <v-ob tag="div" class="mb-10" ref="vob">
                        <v-p 
                            v-slot="{ errors }"
                            name="網頁標題"
                            rules="required|max:20|min:3"
                            tag="div"
                        >
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold">設定連結名稱</span>
                                </label>
                                <input v-model="vUri" type="text" placeholder="連結名稱"
                                    class="input input-bordered w-full">
                                <div>
                                    <span v-for="e in serverErrors" class="badge badge-error mt-1 mr-1">@{{ e }}</span>
                                </div>
                                <div>
                                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">@{{ errors[0] }}</span>
                                </div>
                            </div>
                        </v-p>
                    </v-ob>
                    <div class="justify-end card-actions">
                        <button @click="pageCreate" :disabled="loading" class="btn btn-primary">儲存變更</button>
                    </div>
                </div>
            </modal> --}}
        </div>
    </div>
@endsection

@section('script')
<script>
    let userId = '{{ $userId }}';
    let pageCreateApi = '{{ $pageCreateApi }}';
</script>
<script>
    Vue.use(window["vue-js-modal"].default);
    const app = new Vue({
        el: '#app',
        data() {
            return {
                vUri: '',
                loading: false,
                serverErrors: []
            }
        },
        methods: {
            show() {
                this.$modal.show('create-v-page');
            },
            hide() {
                this.$modal.hide('create-v-page');
            },
            pageCreate() {

                this.$refs.vob.validate()
                    .then(rs => {
                        if(!rs) {
                            throw 'validate error'
                        }
                        return axios.post(pageCreateApi, {
                            user_id: userId,
                            page_url: this.vUri,
                        })

                    }).then(rs => {
                        console.log(rs)
                        alert('新增成功!')
                        location.reload();
                    }).catch(err => {
                        this.loading = false;

                        if(err.response) {
                            console.log(err.response.data)
                            this.serverErrors = err.response.data.data
                        } else {
                            console.log(err)
                        }
                    })

            }
        },
        watch: {
            vUri() {
                this.serverErrors = [];
            }
        }
    })
</script>
@endsection
