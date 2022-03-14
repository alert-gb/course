<template>
  <!-- Modal -->
  <Teleport to="body">
  <div
    class="modal fade"
    id="publicModal"
    tabindex="-1"
    aria-labelledby="ModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{ title }}</h5>
          <button
            type="button"
            class="btn btn-sm btn-dark text-white"
            data-dismiss="modal"
            aria-label="Close"
          >
            X
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </Teleport>
  <!-- End Modal -->
</template>

<script>
export default {
  props: ["title"],
};
</script>
