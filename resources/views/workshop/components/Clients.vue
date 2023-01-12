<template>
   <div class="mt-3">
       <b-tabs>
           <b-tab lazy>
               <template #title>
                   Lista Klientów
               </template>
               <clients-list></clients-list>
           </b-tab>
           <b-tab lazy>
               <template #title>
                   Lista Zarchiwizowanych klientów
               </template>
               <archived-clients-list></archived-clients-list>
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
}
</script>
