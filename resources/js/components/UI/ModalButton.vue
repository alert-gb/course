<template>
  
    <button
      type="button"
      :class="btnClass"
      data-toggle="modal"
      data-target="#publicModal"
    >
      <slot></slot>
    </button>
</template>
<script>
export default {
  props: ["dataTarget", "btnClass"],
};
</script>