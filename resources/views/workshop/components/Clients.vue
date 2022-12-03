<template>
   <div class="mt-3">
       <nav>
           <div class="nav nav-tabs ps-3" id="nav-tab" role="tablist">
               <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lista Klientów</button>
               <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Lista Pojazdów</button>
              </div>
       </nav>
       <div class="tab-content" id="nav-tabContent">
           <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <clients-list></clients-list>
           </div>
           <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <car-list></car-list>
           </div>
       </div>
   </div>
</template>

<script>
export default {
    name: 'Clients',
}
</script>
