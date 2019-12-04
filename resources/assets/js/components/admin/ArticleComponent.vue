<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-around">
        <div class="col-md-10">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manage article</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="postId">Add New Post</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.title"
                    placeholder="Add New Post"
                    name="title"
                    :class="{ 'is-invalid': form.errors.has('title') }"
                  />
                  <has-error :form="form" field="title"></has-error>
                </div>

                <div class="form-group">
                  <label for="descriptionId">Add New Description</label>
                  <markdown-editor
                    name="description"
                    v-model="form.description"
                    :class="{ 'is-invalid': form.errors.has('description') }"
                  >
                    <has-error :form="form" field="description"></has-error>
                  </markdown-editor>
                </div>

                <div class="form-group">
                  <label>Select</label>
                  <select
                    v-model="form.category_id"
                    :class="{ 'is-invalid': form.errors.has('category_id') }"
                  >
                    <option value>Select Category</option>
                    <option
                      v-for="category in getAllCategory"
                      :value="category.id"
                      :key="category.id"
                    >{{ category.name }}</option>
                    <has-error :form="form" field="category_id"></has-error>
                  </select>
                </div>

                <div class="form-group">
                  <input
                    type="file"
                    @change="uploadPhoto"
                    name="photo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('photo') }"
                  />
                  <has-error :form="form" field="photo"></has-error>
                </div>

                <div class="form-group">
                  <input name="status" v-model="form.status" type="checkbox" /> Publish ?
                </div>
              </div>
              <div class="card-footer">
                <input
                  type="submit"
                  class="btn btn-primary"
                  @click.prevent="submitArticle"
                  value="Save"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        title: "",
        description: "",
        category_id: "",
        photo: "",
        status: ""
      })
    };
  },
  mounted() {
    this.$store.dispatch("allCategoryFromDatabase");
  },
  computed: {
    getAllCategory() {
      //final output from here
      return this.$store.getters.getCategoryFormGetters;
    }
  },
  methods: {
    uploadPhoto(e) {
      let file = e.target.files[0];

      let reader = new FileReader();

      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          // console.log('RESULT', reader.result)
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        alert("File size can not be bigger than 2 MB");
      }
    },
    submitArticle() {
      this.form
        .post("api/article")
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "File uploaded successfully"
          });
          this.$router.push("/postlist");
        })
        .catch(() => {
          console.log("Error");
        });
    }
  }
};
</script>
