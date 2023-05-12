<template>
    <div class="w-100">
        <div v-if="$store.state.auth.authenticated === 'logged'" class="d-flex w-100">
            <div class="sidebar__container">
                <sidebar></sidebar>
            </div>
            <div class="content">
                <header-nav name="test"></header-nav>
                <div class="pager">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <div v-else>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import sidebar from '@workshop/Sidebar'
import headerNav from '@workshop/Header'
export default {
    components: {
        sidebar,
        headerNav
    }
}
</script>
