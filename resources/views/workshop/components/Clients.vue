<template>
   <div class="mt-3">
       <b-tabs v-if="$route.name === 'workshop.clients'">
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
       <router-view v-if="$route.name !== 'workshop.clients'"></router-view>
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
