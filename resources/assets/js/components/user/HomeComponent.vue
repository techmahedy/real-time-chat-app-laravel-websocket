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
          <div class="post-preview" v-for="post in allBlogPost" :key="post.id">
            <router-link :to="`/blog/${post.id}`" href>
              <h2 class="post-title">{{ post.title }}</h2>
            </router-link>
            <p class="post-subtitle">{{ post.description | SplitDescription }}</p>

            <p class="post-meta">
              Posted by
              <a href>{{ post.user.name }}</a>
              Category
              <a href>{{ post.category.name }}</a>
              {{ post.created_at | formatDate }}
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
import BlogSidebar from "./SidebarComponent.vue"

export default {
  name: "BlogHome",
  components: {
    BlogSidebar
  },
 computed: {
  allBlogPost() {
    return this.$store.getters.getAllPostFromGetters;
   }
  },
  methods: {
    getAllCategoryPost() {
      if (this.$route.params.id != null) {
        this.$store.dispatch("getPostByCatId", this.$route.params.id);
      } else {
        //this.$store.dispatch("allPostFromDatabase");
        alert('Post not found')
      }
    }
  },
  mounted() {
    this.$store.dispatch("allPostFromDatabase");
  },

  watch: {
    $route(to, from) {
      this.getAllCategoryPost();
    }
  }
  };
</script>
<style scoped>
</style>