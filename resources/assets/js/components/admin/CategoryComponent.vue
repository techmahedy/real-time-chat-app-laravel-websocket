<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create new category</div>

          <div class="card-body">
            <div class="card card-primary">
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input
                      type="text"
                      name="name"
                      v-model="form.name"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" v-model="form.status" class="form-check-input" />
                    <label class="form-check-label" for="exampleCheck1">Publish ?</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button
                    type="submit"
                    @click.prevent="insertCategory"
                    class="btn btn-primary"
                  >Submit</button>
                </div>
              </form>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="item in categories" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.status == true ? 'Active' : 'Draft' }}</td>

                    <td>
                      <a href="#">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      |
                      <a href="#">
                        <i class="fa fa-trash red"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      form: new Form({
        name: "",
        status: ""
      })
    };
  },
  methods: {
    insertCategory() {
      this.form
        .post("api/category")
        .then(() => {
          Swal.fire("Good job!", "You submitted the data!", "success");

          Fire.$emit("loadCategoryTableAfterCreate");
        })
        .catch(() => {
          console.log("Error....");
        });
    },
    loadCategory() {
      axios.get("api/category").then(response => {
        console.log(response);
        this.categories = response.data.categories;
      });
    }
  },
  created() {
    this.loadCategory();
    Fire.$on("loadCategoryTableAfterCreate", () => {
      this.loadCategory();
    });
  }
};
</script>
