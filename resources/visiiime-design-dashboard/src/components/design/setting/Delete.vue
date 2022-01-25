<template>
    <div>
        <div class="card shadow-md mb-3 p-3 bg-white relative">
            <h2 class="card-title">刪除頁面</h2> 
            <p>刪除後將無法再編輯、瀏覽或復原此頁面。</p> 
            <div class="card-actions justify-end space-x-2 card-actions">
                <button @click="pageDeleteConfirm()" class="btn btn-sm bg-red-500 border-none">確定刪除</button> 
            </div>
            
        </div>
        <confirm-modal 
            :modal-name="'delete-confirm-modal'"
            @confirm="pageDelete()" 
        />
    </div>
</template>

<script>
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";

export default {
    components: {
        ConfirmModal
    },
    methods: {
        pageDeleteConfirm() {
            this.$modal.show('delete-confirm-modal', {
                header: '確定要刪除嗎？刪除後將無法再編輯、瀏覽或復原此頁面。',
            })

        },
        async pageDelete() {

            try {
                let pageId = this.$store.state.pageId;
                await vBasicPageApi.pageDelete({
                    page_id: pageId
                })

                alert('刪除成功');

                window.location.href = '/v-dashboard';
                
            } catch (err) {

                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            }
        }
    }
}
</script>
