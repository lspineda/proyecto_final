<template>
  <div class="wrap">
    <div class="body">
      <div class="row">
        <div class="col-md-4">
          <select class="form-control select2" data-live-serach="true" @change="getProduct()" v-model="category"
            v-select="category">
            <option value>Todas las categorías</option>

            <option v-for="(cat, index) in categorys" :value="cat.id">{{ cat.name }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select class="form-control select2" data-live-serach="true" @change="getData(1)" v-model="product"
            v-select="product">
            <option value>Todos los productos</option>

            <option v-for="(pd, index) in products" :value="pd.id">{{ pd.name }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select class="form-control select2" data-live-serach="true" @change="getData(1)" v-model="vendor"
            v-select="vendor">
            <option value>Todos los proveedores</option>

            <option v-for="(vd, index) in vendors" :value="vd.id">{{ vd.name }}</option>
          </select>
        </div>
      </div>

      <div class="loading" v-if="isLoading">
        <h2 style="text-align:center">Cargando...</h2>
      </div>

      <div class="table-responsive" v-else>
        <table class="table table-condensed table-hover table-bordered">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Categoría</th>
              <th>Proveedor</th>
              <th>Existencia inicial</th>
              <th>Existencia actual</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Entrada por</th>
              <th>Fecha de entrada</th>
              <th class="align-center">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(value, index) in stocks.data">
              <td>{{ value.product.name }}</td>
              <td>{{ value.category.name }}</td>
              <td>{{ value.vendor.name }}</td>
              <td>{{ value.stock_quantity }}</td>
              <td>{{ value.current_quantity }}</td>
              <td>{{ value.buying_price }}</td>
              <td>{{ value.selling_price }}</td>
              <td>{{ value.user.name }}</td>
              <td>{{ value.created_at | moment('LL') }}</td>
              <td class="align-center">
                <button @click="deleteStock(value.id)" type="button"
                  class="btn bg-pink btn-circle waves-effect waves-circle waves-float">
                  <i class="material-icons">delete</i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <pagination :pageData="stocks"></pagination>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../vue-asset";
import mixin from "../../mixin.js";
import MomentMixin from "../../moment_mixin.js";

import Pagination from "../pagination/pagination.vue";

export default {
  props: ["categorys", "vendors"],

  mixins: [mixin, MomentMixin],

  components: {
    pagination: Pagination,
  },

  data() {
    return {
      stocks: [],
      name: "",
      product: "",
      category: "",
      vendor: "",
      products: [],
      isLoading: true,
    };
  },
  created() {
    var _this = this;
    this.getData();

    EventBus.$on("stock-created", function () {
      window.history.pushState({}, null, location.pathname);
      _this.getData();
    });
  },

  methods: {
    getData(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
          "stock-list?page=" +
          page +
          "&product=" +
          this.product +
          "&category=" +
          this.category +
          "&vendor=" +
          this.vendor
        )
        .then((response) => {
          this.stocks = response.data;
          this.isLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getProduct() {
      if (this.category === "") {
        this.products = [];

        this.product = "";
      } else {
        this.products = [];
        axios
          .get(base_url + "category/product/" + this.category)
          .then((response) => {
            this.products = response.data;
          });
      }

      this.getData(1);
    },

    // delete vendor

    deleteStock(id) {
      Swal(
        {
          title: "¿Estás seguro?",
          text: "¡No podrás revertir esto!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "¡Sí, eliminar!",
        },
        () => { }
      ).then((result) => {
        if (result.value) {
          axios.get(base_url + "stock/delete/" + id).then((res) => {
            EventBus.$emit("stock-created", 1);

            this.successALert(res.data);
          });
        }
      });
    },

    pageClicked(pageNo) {
      var vm = this;
      vm.getData(pageNo);
    },
  },

  computed: {},
};
</script>