<template>
  <div class="col-lg-4 col-md-4 mx-auto" id="sidebar">

       <div class="widget" style="margin-bottom:10px;">
        <form class="form-search">
          <input @keyup="RealSearch" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
        </form>
      </div>  

    <h4>CATEGORY</h4>
    <ul>
      <li v-for="category in getAllCategory" :key="category.id">
        <router-link :to="`/categories/${category.id}`" href>{{ category.name }}</router-link>
      </li>
    </ul>
    <h4>LATEST POST</h4>
    <ul>
      <li v-for="post in sidebarPost" :key="post.id">
        <router-link :to="`/blog/${post.id}`" href>{{ post.title }}</router-link>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  
  data() {
      return {
         keyword:''
       }
  },

  computed: {
    
    getAllCategory() {
      return this.$store.getters.getCategoryFormGetters;
    },
    sidebarPost() {
      return this.$store.getters.getAllPostFromGetters;
    }
  },
  mounted() {
    this.$store.dispatch("allCategoryFromDatabase");
    this.$store.dispatch("allPostFromDatabase");
  },
  methods: {

    RealSearch() {
        this.$store.dispatch('SearchPost',this.keyword);
    }
       
  }
};
</script>