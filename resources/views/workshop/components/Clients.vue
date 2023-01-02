<template>
   <div class="mt-3">
       <b-tabs>
           <b-tab>
               <template #title>
                   Lista Klientów
               </template>
               <clients-list></clients-list>
           </b-tab>
           <b-tab @click="showned_tabs.push('archive')">
               <template #title>
                   Lista Zarchiwizowanych klientów
               </template>
               <archived-clients-list
                   v-if="showned_tabs.includes('archive')"
               ></archived-clients-list>
           </b-tab>
       </b-tabs>
   </div>
</template>

<script>
import archivedClientsList from './Clients/Archived/list';
export default {
    name: 'Clients',
    components: {
        archivedClientsList
    },
    data() {
        return {
            showned_tabs: []
        }
    }
}
</script>
