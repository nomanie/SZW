import Sortable, {AutoScroll} from 'sortablejs/modular/sortable.core.esm.js';

var dtMixin = {
    data() {
        return {
            table_id: this.tableId,
            modal_id: this.modalId,
            data: {},
            dndInitialized: false
        }
    },
    mounted() {
        let _self = this
        // obsługa dropdown action buttons
        document.addEventListener("click", function (e) {
            const target = e.target.closest(".dt-ajax");
            if (target) {
                e.preventDefault()
                _self[target.dataset.type](target.dataset.href)
            }
        });
        // obsługa column drag and drop
        this.waitForElement('.dataTable > thead > tr').then((elm) => {
            let sort = Sortable.create(document.querySelector('.dataTable > thead > tr'), {
                onEnd: function (/**Event*/evt) {
                    var itemEl = evt.item;  // dragged HTMLElement
                    evt.to;    // target list
                    evt.from;  // previous list
                    evt.oldIndex;  // element's old index within old parent
                    evt.newIndex;  // element's new index within new parent
                    evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
                    evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
                    evt.clone // the clone element
                    evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
                    _self.$http.post(route('admin.datatables.reorder', _self.table_id), {old_index: evt.oldIndex, new_index: evt.newIndex}).then((response) => {
                        _self.reloadDT()
                    })
                },
            });

        });
    },
    methods: {
        delete(href) {
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
        },
        waitForElement(selector) {
            return new Promise(resolve => {
                if (document.querySelector(selector)) {
                    return resolve(document.querySelector(selector));
                }

                const observer = new MutationObserver(mutations => {
                    if (document.querySelector(selector)) {
                        resolve(document.querySelector(selector));
                        observer.disconnect();
                    }
                });

                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });
        }
    }
}
export default dtMixin
