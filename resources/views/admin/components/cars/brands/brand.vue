<template>
    <div class="container mt-3">
        <div>
            <div class="d-flex justify-content-end">
                <modal
                    :data="data"
                    @reload="reloadDT()"
                ></modal>
            </div>
        </div>
    </div>
</template>
<script>
import modal from './modal'
import dtMixin from '@js/mixins/dtMixin'
export default {
    components: {
        modal,
    },
    props: {
        tableId: {
            type: String,
            default: () => null
        },
        modalId: {
            type: String,
            default: () => null
        }
    },
    mixins: [dtMixin],
}
</script>
