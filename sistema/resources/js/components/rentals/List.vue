<template>
  <div>
    <div class="table-responsive tableFixHead">
      <table class="table text-vertical-center">
        <tbody v-if="data.length > 0">
          <tr v-for="(item, index) in data" :key="index">
            <td class="col-2 text-left">{{ item.clientnames }} {{item.clientsurnames}}</td>
            <td class="col-2 text-center">{{ item.movietitle }}</td>
            <td class="col-2 text-center">{{ item.delivery_date }}</td>
            <td class="col-2 text-center">{{ item.return_date }}</td>
            <td class="col-2">{{ item.description }}</td>
            <td class="col-2 text-center">
              <a
                class="btn btn-outline-dark p-0"
                style="border: none"
                :href="'/alquiler/editar/' + item.id"
                role="button"
                ><i
                  class="bi bi-pencil-square bi-light"
                  style="font-size: 13pt"
                ></i
              ></a>
              <a
                class="btn btn-outline-dark p-0"
                style="border: none"
                href="#"
                @click="confirm(item)"
                role="button"
                ><i class="bi bi-trash" style="font-size: 13pt"></i
              ></a>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr>
            <td colspan="6">
              No existe alquileres registrados
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modal -->
    <button id="launchConfirm" type="button" class="btn btn-primary" style="display: none;" data-bs-toggle="modal" data-bs-target="#confirm">
            Launch demo modal
        </button>
    <div
      class="modal fade"
      id="confirm"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog text-white">
        <div class="modal-content bg-main">
          <div class="modal-header">
            <h5 id="modal-title" class="modal-title">
              Desea eliminar a <b>{{modalData.title}}</b> ?
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <!-- <div id="modal-body" class="modal-body">...</div> -->
          <div class="modal-footer">
            <button
              type="button"
              data-bs-dismiss="modal"
              @click="del(modalData);"
              class="btn btn-outline-light"
            >
              OK
            </button>
            <button
              data-bs-dismiss="modal"
              type="button"
              class="btn btn-outline-light"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import axios from "axios";
export default {
  data: (vm) => ({
    data: [],
    modalData: {
      name: ''
    },
  }),
  methods: {
    loadData() {
      const vm = this;
      console.log("loadData");
      axios["get"]("api/rentals/list", {
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log("loadData", res.data.response);
          vm.data = res.data.response;
        })
        .catch((error) => {
          console.log("loadData", error);
        });
    },
    confirm(item) {
      this.modalData = item;
      $('#launchConfirm').click();
    },
    del(item) {
      // console.log("Delete", item);
      axios['post']('/api/rentals/delete', {id: item.id},{
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log("registrar", res.data.response);         
          $('#modal-body').html(res.data.response);
          $('#launchNotication').click();
          $('#modal-close').on('click', () => {
          });
          this.loadData();
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
    this.loadData();
  },
};
</script>
