<template>
  <span id="homemain">
    <!-- Page Header -->
    <header class="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Clean Blog</h1>
              <span class="subheading">A Blog Theme by Start Bootstrap</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 mx-auto">
          <div class="post-preview">
            <h2 class="post-title">{{ getPost.title }}</h2>

            <p class="post-subtitle">{{ getPost.description }}</p>

            <p class="post-meta">
              Posted by
              <a href v-if="getPost.user">{{ getPost.user.name }}</a>
              Category
              <a href>{{ getPost.category.name }}</a>
              {{ getPost.created_at | formatDate }}
            </p>
          </div>
        </div>

        <BlogSidebar />
      </div>
    </div>

    <hr />
  </span>
</template>

<script>
import BlogSidebar from "./SidebarComponent.vue";
export default {
  name: "SingleBlog",
  components: {
    BlogSidebar
  },
  computed: {
    getPost() {
      return this.$store.getters.getSinglePostFromGetters;
    }
  },
  methods: {
    getSinglePost() {
      this.$store.dispatch("getPostBySlug", this.$route.params.id);
    }
  },
  mounted() {
    this.getSinglePost();
  },
  watch: {
    $route(to, from) {
      this.getSinglePost();
    }
  }
};
</script>

<style scoped>
</style>