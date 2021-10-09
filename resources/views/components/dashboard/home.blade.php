@extends('components.dashboard.layouts.main')

@section('content')

    <div class="container mx-auto pt-10 px-4 max-w-3xl">
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
                                    <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}"
                                        class="btn btn-xs">編輯</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

        <div id="app" class="mt-5">
            <button @click="show" class="btn btn-primary w-full">新增頁面</button>
            <modal name="create-v-page" :max-width="600" width="90%" height="auto" :adaptive="true">
                <div class="card shadow-md p-3 bg-white relative">
                    <div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold">設定連結名稱</span>
                            </label>
                            <input v-model="vUri" type="text" placeholder="連結名稱"
                                class="input input-bordered w-full">
                            <div>
                                <span class="badge badge-error mt-1 mr-1" style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="justify-end card-actions">
                        <button disabled="disabled" class="btn btn-primary">儲存變更</button>
                    </div>
                </div>
            </modal>
        </div>
    </div>
@endsection

@section('script')
    <script>
        Vue.use(window["vue-js-modal"].default);
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    vUri: ''
                }
            },
            methods: {
                show: function() {
                    this.$modal.show('create-v-page');
                },
                hide: function() {
                    this.$modal.hide('create-v-page');
                },
            }
        })
    </script>
@endsection
