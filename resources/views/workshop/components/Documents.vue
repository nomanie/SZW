<template>
    <div class="mt-3">
        <b-tabs>
            <b-tab lazy>
                <template #title>
                    Lista Dokumentów
                </template>
                <documents-table></documents-table>
            </b-tab>
            <b-tab lazy>
                <template #title>
                    Archiwum
                </template>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
import documentsTable from './Documents/list.vue'
export default {
    components: {
        documentsTable
    },
}
</script>
