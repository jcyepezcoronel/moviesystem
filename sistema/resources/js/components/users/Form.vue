<template>
<div>
  <form class="row g-3 needs-validation" novalidate>
    <div class="col-md-4">
      <label for="validationCustom01" class="form-label">Nombre</label>
      <input type="text" class="form-control" v-model="form.name" id="name" value="" required />
      <div class="invalid-feedback">Este campo es requerido</div>
    </div>
    <div class="col-md-4">
      <label for="validationCustom02" class="form-label">Usuario</label>
      <input type="text" class="form-control" v-model="form.user_name" id="user_name" />
      <div class="invalid-feedback">Este campo es requerido</div>
    </div>
    <div class="col-md-4">
      <label for="validationCustom02" class="form-label">Correo</label>
      <input type="text" class="form-control" v-model="form.email" id="email" value="" required />
      <div class="invalid-feedback">Este campo es requerido</div>
    </div>
    <div class="col-md-12">
      <label for="validationCustom02" class="form-label">Clave</label>
      <input
        type="password"
        class="form-control"
         v-model="form.password"
        id="password"
        value=""
        :required="user ? false : true "
      />
      <div class="invalid-feedback">Este campo es requerido</div>
    </div>

    <div class="col-12">
      <button class="btn btn-outline-dark" type="button" @click="validar">
        {{user ? 'Actualiza' : 'Registrar'}}
      </button>
    </div>
  </form>
</div>
</template>

<script>
import $ from 'jquery'
import axios from "axios";
export default {
  props:{
    user: Object,
    default: {}
  },
  data(){
  return {
    form: {
      name: this.user ? this.user.name : null,
      user_name: this.user ? this.user.user_name : null,
      email: this.user ? this.user.email : null,
      password: null
      }
    }
  },
  methods: {
    validar() {
        const vm = this,
        forms = document.querySelectorAll(".needs-validation");
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms).forEach( (form) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add("was-validated");
        } else {
          if(this.user){
            vm.update();
          } else {
            vm.registrar();
          }
        }
      });
    },
    update(){
      axios["put"]("/usuarios/" + this.user.id , this.form, {
        headers: {
          "Content-Type": "application/json"
        },
      })
      .then((res) => {
        $('#modal-body').html('Usuario actualizado exitosamente');
        $('#launchNotication').click();
        $('#modal-close').on('click', () => {
          window.location.href = '/usuarios';
        })
      })
      .catch((error) => {
        console.log("registrar", error);
      });
    },
    registrar() {
      axios["post"]("/usuarios", this.form, {
        headers: {
          "Content-Type": "application/json"
        },
      })
      .then((res) => {
        // window.location.href = '/usuarios'
        $('#modal-body').html('Usuario almacenado correctamente');
        $('#launchNotication').click();
        $('#modal-close').on('click', () => {
          window.location.href = '/usuarios';
        })
      })
      .catch((error) => {
        console.log("registrar", error);
      });
    }
  },
};
</script>
