<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">

           <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="getProfilePhoto()" alt="User profile picture">
                </div>
              </div>
            </div>


        <div class="tab-pane active" id="settings">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="email" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error> 
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" v-model="form.email" class="form-control" id="inputEmail" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputName2" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <input type="text" v-model="form.type" class="form-control" id="inputName2" placeholder="Name">
                </div>
              </div>
      
              <div class="form-group row">
                <label for="inputSkills" class="col-sm-2 col-form-label">Avatar</label>
                <div class="col-sm-10">
                  <input type="file" @change='uploadProfile' name="photo" class="form-control">
                </div>
              </div>
             
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" @click.prevent="updateInfo" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>
            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {

                form: new Form({
                    id: '',
                    name : '',
                    email: '',
                    type: '',
                    photo: ''
                })
            }
        },
        methods: {

            getProfilePhoto(){
                let photo = (this.form.photo.length > 100) ? this.form.photo : "img/profile/"+ this.form.photo;
                return photo;

            },
            uploadProfile(e){

                let file = e.target.files[0];
                let reader = new FileReader();  

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                   // console.log('RESULT', reader.result)
                     this.form.photo = reader.result;
                    }              
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            },
            updateInfo(){
                this.form.put('api/profile/')
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'Profile updated successfully'
                    })

                    this.getProfilePhoto()
                    $('#addNew').modal('hide');
               })
               .catch(()=>{
                  console.log("Error.....")
               })
            },
          
        },
        created() {
            axios.get('api/profile')
                 .then(({data}) => (this.form.fill(data)))
                 .catch(() => {
                    console.log("Error......")
                 })
        }
        
    }
</script>
