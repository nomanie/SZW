var dtMixin = {
    data() {
      return {
          table_id: this.tableId,
          modal_id: this.modalId,
          data: {}
      }
    },
    mounted() {
        let _self = this
        document.addEventListener("click", function(e){
            const target = e.target.closest(".dt-ajax");
            if(target){
                e.preventDefault()
                _self[target.dataset.type](target.dataset.href)
            }
        });
    },
    methods: {
        delete(href){
            this.$http.delete(href).then((response) => {
                this.reloadDT()
            })
        },
        reloadDT() {
            $('#' + this.table_id).DataTable().ajax.reload();
        },
        edit(href) {
            this.$http.get(href).then((response) => {
                this.data = response.data.data;
                this.isEdit = true
            })
        },
        show(href) {
        }
    }
}
export default dtMixin
