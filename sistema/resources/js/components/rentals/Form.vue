<template>
  <div>
    <form class="row g-3 needs-validation" novalidate>
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Cliente</label>
        <select v-model="form.client_id" id="category_id" class="form-select" aria-label="Clientes" :disabled="mode == 'edit'" required>
          <option selected value="">Seleccione</option>
          <option v-for="(client, index) in clients" :key="index" :value="client.id" :selected="form.client_id == client.id ? true : false">{{client.names}}</option>
        </select>
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Pelicula</label>
        <select v-model="form.movie_id" id="category_id" class="form-select" aria-label="Peliculas" :disabled="mode == 'edit'" required>
          <option selected value="">Seleccione</option>
          <option v-for="(movie, index) in movies" :key="index" :value="movie.id" :selected="form.movie_id == movie.id">{{movie.title}}</option>
        </select>
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>

      <div class="col-md-4">
      </div>
      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Fecha de Inicio</label>
        <div>
          <date-picker v-model="form.delivery_date" required format="DD/MM/YYYY" valueType="YYYY-MM-DD"></date-picker>
        </div>
        <input
          type="text"
          style="display: none;"
          class="form-control"
          v-model="form.delivery_date"
          id="date"
          value=""
          required
        />
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Fecha de Devolución</label>
        <div>
          <date-picker v-model="form.return_date" required format="DD/MM/YYYY" valueType="YYYY-MM-DD"></date-picker>
        </div>
        <input
          type="text"
          style="display: none;"
          class="form-control"
          v-model="form.return_date	"
          id="date"
          value=""
          required
        />
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>


      <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Descripción</label>
        <input
          type="text"
          class="form-control"
          v-model="form.description"
          id="description"
          value=""
          :disabled="mode == 'edit'"
        />
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>

      <div class="col-12">
        <button
          v-if="mode == 'register'"
          class="btn btn-outline-dark"
          type="button"
          @click="validar"
        >
          REGISTRAR
        </button>
        <button
          v-if="mode == 'edit'"
          class="btn btn-outline-dark"
          type="button"
          @click="validar"
        >
          EDITAR
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import $ from "jquery";
import axios from "axios";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
  components: { DatePicker },
  props: ["data", "mode"],
  data: (vm) => ({
    categories: [],
    clients: [],
    movies: [],
    image: null,
    form: {
      client_id: null,
      movie_id: null,
      delivery_date: null,
      description: null,
    },
  }),
  computed : {
    years () {
      const year = new Date().getFullYear()
      return Array.from({length: year - 1900}, (value, index) => 1901 + index)
    }
  },
  mounted() {
    console.log("Component mounted.", this.mode, this.data);
    this.getMovies();
    this.getClients();
    if (this.mode == "edit") {
      this.form = this.data;
    }
  },
  methods: {
    async validar() {
      const vm = this,
        forms = document.querySelectorAll(".needs-validation");

        console.log(this.form.delivery_date);

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add("was-validated");
        } else {
            vm.procesar();
        }
      });
    },
    procesar() {
      console.log("registrar form", this.form);
      let method, url;

      if (this.mode == "register") {
        method = "post";
        url = "/api/rentals/store";
      }

      if (this.mode == "edit") {
        method = "post";
        url = "/api/rentals/update";
      }
      axios[method](url, this.form, {
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log("registrar", res.data.response);
          $("#modal-body").html(res.data.response);
          $("#launchNotication").click();
          $("#modal-close").on("click", () => {
            window.location.href = "/alquiler";
          });
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
    getMovies() {
      const vm = this;
      axios['get']('/api/movies/list', {
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log('movies', res.data.response)
          vm.movies = res.data.response;   
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
    getClients() {
      const vm = this;
      axios['get']('/api/clients/list', {
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log('movies', res.data.response)
          vm.clients = res.data.response;   
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
  },
};
</script>
