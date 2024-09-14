<template>
  <button class="btn border-0" style="position: relative">
    <font-awesome-icon :icon="icon" class="fs-5" />
    <span :class="badge" style="position: absolute; top: -3px; right: 0px">{{
      count
    }}</span>
  </button>
</template>

<script setup>
import { ref,defineProps } from "vue";

const props = defineProps({
  icon: String,
  count: Number,
  from: String,
});

const badge = ref('');

const isFloatingIcon = () => {
    if(props.from === 'floatingIcon'){
        badge.value = "badge floatingIconBadge rounded-pill";
    }else{
        badge.value = "badge normalBadge rounded-pill";
    }
}

isFloatingIcon();

</script>

<style scoped>
.normalBadge {
  font-size: 10px;
  background-color: #fe919d;
}
.floatingIconBadge{
    font-size: 12px;
    background-color: #ea4a5c;
    color: white;
}
</style>
