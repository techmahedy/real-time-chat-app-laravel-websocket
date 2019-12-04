export default {

       state: {

              category: [],
              post: [],
              singlepost: [],

       },

       getters: {

              getCategoryFormGetters(state) { //take parameter state

                     return state.category
              },
              getAllPostFromGetters(state) {

                     return state.post

              },
              getSinglePostFromGetters(state) {

                     return state.singlepost

              }
       },

       actions: {
              allCategoryFromDatabase(context) {

                     axios.get("api/category")

                            .then((response) => {
                                   console.log(response.data.categories)
                                   context.commit("categories", response.data.categories) //categories will be run from mutation

                            })

                            .catch(() => {
                                   console.log("Error.......")
                            })
              },
              allPostFromDatabase(context) {

                     axios.get("api/article")

                            .then((response) => {
                                   console.log(response.data.posts)
                                   context.commit("posts", response.data.posts) //posts will be run from mutation

                            })

                            .catch(() => {
                                   console.log("Error.......")
                            })
              },
              getPostBySlug(context, payload) { //payload id from dispatch
                     axios.get('/blog/' + payload)
                            .then((response) => {
                                   context.commit('siglePost', response.data.post)
                            }).catch(() => {
                                   console.log("Error......")
                            })
              },
              getPostByCatId(context, payload) {
                     axios.get('/categorypost/' + payload)
                            .then((response) => {
                              console.log(response.data.post)
                                   context.commit('getCatPost', response.data.post)
                            })
              },
              SearchPost(context, payload) {
                   axios.get('/search?s=' + payload)
                       .then((response) => {
                           context.commit('getSearchPost', response.data.post)
                       })

                  },
              },

       mutations: {
              categories(state, data) {
                     return state.category = data
              },
              posts(state, data) {
                     return state.post = data
              },
              siglePost(state, payload) {
                     return state.singlepost = payload
              },
              getCatPost(state, payload) {
                     state.post = payload
              },
              getSearchPost(state, payload){
                     state.post = payload
              }
       }
}