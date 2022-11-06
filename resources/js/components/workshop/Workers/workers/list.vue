<template>
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <div class="btn-add">
                <i class="fa fa-plus"></i>
                <div class="cut"></div>
                <div class="text">
                    Pracownika
                </div>
            </div>
        </div>
        <vuetable ref="vuetable"
                  :api-url="apiUrl"
                  :fields="fields"
                  :data="table"
                  :css="style.table"
        ></vuetable>
    </div>
</template>
<script>
import vuetableStyle from "../../../../config/styles/vuetable";
export default {
    data() {
      return {
          table: null,
          style: vuetableStyle,
          fields: [
              {
                  name: 'first_name',
                  sortField: 'first_name',
                  title: 'Imię'
              },
              {
                  name: 'last_name',
                  sortField: 'last_name',
                  title: 'Nazwisko'
              },
              {
                  name: 'email',
                  sortField: 'email',
                  title: 'E-mail'
              },
              {
                  name: 'position',
                  sortField: 'position',
                  title: 'Stanowisko'
              },
          ]
      }
    },
    computed: {
      apiUrl() {
          return route('api.workers.index');
      }
    }
}
</script>
