<template>
    <div class="container mt-3">
        <div>
            <div class="d-flex justify-content-end">

            </div>
            <datatable
                :table-id="`car-brand-table`"
                api-url="admin.cars.brand.index"
                :columns="fields"
            >
            </datatable>
        </div>
    </div>
</template>
<script>
import modal from './modal'
import DataTables from "../../../../../js/components/dataTables";
export default {
    components: {
        DataTables,
        modal,
    },
    data() {
      return {
          test: false,
          apiUrl: route('admin.cars.brand.index'),
          fields: [
              {
                  data: 'id',
                  name: 'id',
                  title: 'ID'
              },
              {
                  data: 'name',
                  name: 'name',
                  title: 'Marka'
              },
              {
                  data: 'action',
                  name: 'action',
                  title: 'Akcja',
                  orderable: false,
                  className: 'not-exportable',
                  exportable: false
              },
          ]
      }
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
}
</script>
