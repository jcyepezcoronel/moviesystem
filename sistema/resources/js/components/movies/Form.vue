<template>
  <div>
    <form class="row g-3 needs-validation" novalidate>
      <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Imagen</label>
        <input class="form-control" type="file" id="imagen" required />
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Titulo</label>
        <input
          type="text"
          class="form-control"
          v-model="form.title"
          id="names"
          value=""
          required
        />
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Categoria</label>
        <select v-model="form.category_id" id="category_id" class="form-select" aria-label="Categoria" required>
          <option selected value="">Seleccione</option>
          <option v-for="(category, index) in categories" :key="index" :value="category.id" :selected="form.category_id == category.id">{{category.name}}</option>
        </select>
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Año</label>
        <select v-model="form.year" id="year" class="form-select" aria-label="Año" required>
          <option selected value="">Seleccione</option>
          <option v-for="(year, index) in years" :key="index" :value="year">{{year}}</option>
        </select>
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-2">
        <label for="validationCustom02" class="form-label">Copias</label>
        <select v-model="form.number_copies" id="category_id" class="form-select" aria-label="Copias" required>
          <option selected value="">Seleccione</option>
          <option v-for="n in 1000" :key="n" :value="n">{{n}}</option>
        </select>
        <div class="invalid-feedback">Este campo es requerido</div>
      </div>
      <div class="col-md-10">
        <label for="validationCustom02" class="form-label">Descripción</label>
        <input
          type="text"
          class="form-control"
          v-model="form.description"
          id="description"
          value=""
          required
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
export default {
  props: ["data", "mode"],
  data: (vm) => ({
    categories: [],
    image: null,
    form: {
      title: null,
      category_id: null,
      year: null,
      image: null,
      number_copies: null,
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
    this.getCategories();
    if (this.mode == "edit") {
      this.form = this.data;
    }
  },
  methods: {
    toBase64() {
      const file = document.getElementById("imagen").files[0];
      var reader = new FileReader();
      reader.onload = function (e) {
        e.target.result;
      };
    },
    async validar() {
      const vm = this,
        forms = document.querySelectorAll(".needs-validation");

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach(function (form) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add("was-validated");
        } else {
          const file = document.getElementById("imagen").files[0],
            reader = new FileReader();
          reader.onload = function (e) {
            vm.form.image = e.target.result;
            vm.procesar();
          };
          reader.readAsDataURL(file);
        }
      });
    },
    procesar() {
      console.log("registrar form", this.form);
      let method, url;

      if (this.mode == "register") {
        method = "post";
        url = "/api/movies/store";
      }

      if (this.mode == "edit") {
        method = "post";
        url = "/api/movies/update";
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
            window.location.href = "/peliculas";
          });
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
    getCategories() {
      const vm = this;
      axios['get']('/movies/categories', this.form, {
        headers: {
          "Content-Type": "application/json",
          //   Authorization: vm.$auth.strategy.token.get(),
        },
      })
        .then((res) => {
          // console.log('Categories', res.data)
          vm.categories = res.data;   
        })
        .catch((error) => {
          console.log("registrar", error);
        });
    },
  },
};
</script>
