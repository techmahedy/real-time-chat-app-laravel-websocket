<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">All Post List</div>

          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Publish Date</th>
                  <th>Modify</th>
                </tr>

                <tr v-for="(post,index) in getAllArticle" :key="post.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ post.title | SplitString}}</td>
                  <td>
                    <img
                      :src="`img/profile/${post.photo}`"
                      class="profile-user-img img-fluid img-circle"
                      style="height:40px; width:40px;"
                    />
                  </td>
                  <td>{{ post.status == true ? "Publish" : "Draft"}}</td>
                  <td>{{ post.created_at | formatDate}}</td>

                  <td>
                    <router-link href="#" :to="`editpost/${post.id}`">
                      <i class="fa fa-edit blue"></i>
                    </router-link>|
                    <a href="#" @click.prevent="deletePost(post.id)">
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
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    deletePost(id) {
      axios
        .delete("api/article/" + id)
        .then(() => {
          this.$store.dispatch("allPostFromDatabase");
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then(result => {
            if (result.value) {
              //Send Request to server
              axios
                .delete("api/article/" + id)
                .then(response => {
                  Swal.fire("Deleted!", "Post deleted successfully", "success");
                 
                })
                .catch(() => {
                  Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: "<a href>Why do I have this issue?</a>"
                  });
                });
            }
          });
        })
        .catch(() => {
          console.log("Error......");
        });
    }
  },
  created() {},
  computed: {
    getAllArticle() {
      //final output from here
      return this.$store.getters.getAllPostFromGetters;
    }
  },
  mounted() {
    this.$store.dispatch("allPostFromDatabase");
  }
};
</script>
