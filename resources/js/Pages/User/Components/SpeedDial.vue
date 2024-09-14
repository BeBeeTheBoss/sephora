<template>
    <v-speed-dial location="right bottom" transition="scale-transition">
        <template v-slot:activator="{ props: activatorProps }" >
            <v-fab v-bind="activatorProps" size="large" class="speed-dial d-lg-none d-md-none d-sm-block d-block" icon="$vuetify">
                <IconBtn icon="fa-solid fa-cart-shopping" from="floatingIcon" count="3" class="icon"/>
            </v-fab>
        </template>

    </v-speed-dial>
</template>

<script setup>
import IconBtn from './IconBtn.vue';

</script>

<style scoped>
.speed-dial{
    position:fixed;
    bottom:140px;
    right:80px;
}

.icon{
    background-color: #fe919d;
    width:60px;
    height:60px;
    border-radius: 50%;
    color:white;
    padding-top:12px
}

</style>
