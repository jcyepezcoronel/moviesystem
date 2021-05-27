<template>
  <div class="table-responsive tableFixHead">
    <table class="table">
      <tbody>
        <tr v-for="(item, index) in users" :key="index">
          <th class="col-1">{{ index + 1 }}</th>
          <td class="col-2">{{ item.name }}</td>
          <td class="col-2">{{ item.user_name }}</td>
          <td class="col-2">{{ item.email }}</td>
          <td class="col-2 text-center">
            <a class="btn btn-outline-dark p-0" style="border: none;" :href="'/usuarios/' + item.id + '/edit'" role="button"><i class="bi bi-pencil-square bi-light" style="font-size: 13pt;"></i></a>   
            <a class="btn btn-outline-dark p-0" style="border: none;" href="#" @click="destroy(item)" role="button"><i class="bi bi-trash" style="font-size: 13pt;"></i></a>  
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props:{
    users: Array
  },
  data: () => ({
    data: [],
  }),
  methods: {
    destroy(el){

    }
  },
};
</script>
