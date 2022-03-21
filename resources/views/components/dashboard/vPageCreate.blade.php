@extends('components.dashboard.layouts.main')

@section('content')

    <div class="container mx-auto pt-5 px-4 max-w-xl">

        <form id="app" class="mt-3" action="{{ $action }}" method="POST">
            @csrf
            <div class="card shadow-md p-3 bg-white relative">
                <div tag="div" class="mb-5" ref="vob">
                    <div 
                        v-slot="{ errors }"
                        name="網頁標題"
                        rules="required|max:20|min:3"
                        tag="div"
                    >
                        <div class="form-control">
                            <label class="label">
                                @if ($isCreate)
                                <span class="font-bold text-xl mb-3">新增個人頁</span>
                                @else
                                <span class="font-bold text-xl mb-3">更改連結名稱</span>
                                @endif
                            </label>
                            <input value="{{ $vPage->page_url ?? old('page_url') }}" name="page_url" v-model="vUri" type="text" placeholder="連結名稱" class="input input-bordered w-full">
                        </div>
                    </div>
                </div>
                <div class="justify-end card-actions">
                    @if ($isCreate)
                    <button type="submit" class="btn btn-primary">新增頁面</button>
                    @else
                    <button type="submit" class="btn btn-primary">更新連結名稱</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    // let userId = ' $userId';
    // let pageCreateApi = ' $pageCreateApi';
</script>
<script>
    // Vue.use(window["vue-js-modal"].default);
    // const app = new Vue({
    //     el: '#app',
    //     data() {
    //         return {
    //             vUri: '',
    //             loading: false,
    //             serverErrors: []
    //         }
    //     },
    //     methods: {
    //         show() {
    //             this.$modal.show('create-v-page');
    //         },
    //         hide() {
    //             this.$modal.hide('create-v-page');
    //         },
    //         pageCreate() {

    //             this.$refs.vob.validate()
    //                 .then(rs => {
    //                     if(!rs) {
    //                         throw 'validate error'
    //                     }
    //                     return axios.post(pageCreateApi, {
    //                         user_id: userId,
    //                         page_url: this.vUri,
    //                     })

    //                 }).then(rs => {
    //                     console.log(rs)
    //                     alert('新增成功!')
    //                     location.reload();
    //                 }).catch(err => {
    //                     this.loading = false;

    //                     if(err.response) {
    //                         console.log(err.response.data)
    //                         this.serverErrors = err.response.data.data
    //                     } else {
    //                         console.log(err)
    //                     }
    //                 })

    //         }
    //     },
    //     watch: {
    //         vUri() {
    //             this.serverErrors = [];
    //         }
    //     }
    // })
</script>
@endsection