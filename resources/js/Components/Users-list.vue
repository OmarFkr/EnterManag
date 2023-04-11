<template>
      <div class="users">
        
        <div class="half">
          
          <h1>Create user</h1>
          
          <form @submit.prevent="createUser">
            
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"/>
            </div>
            <div class="form-group">
                  <label>name</label>
                  <input type="text" v-model="form.name"  maxlength="191" />
                  <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group">
                  <label>email</label>
                  <input type="text" v-model="form.email"  maxlength="191" />
                  <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group">
                  <label>email_verified_at</label>
                  <input type="number" v-model="form.email_verified_at"/>
            </div>
            <div class="form-group">
                  <label>password</label>
                  <input type="text" v-model="form.password"  maxlength="191" />
                  <has-error :form="form" field="password"></has-error>
            </div>
            <div class="form-group">
                  <label>is_admin</label>
                  <input type="number" v-model="form.is_admin"/>
            </div>
            <div class="form-group">
                  <label>remember_token</label>
                  <input type="text" v-model="form.remember_token"  maxlength="100" />
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.created_at"/>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.updated_at"/>
            </div>
            <div class="form-group">
                  <label>address</label>
                  <input type="text" v-model="form.address"  maxlength="191" />
            </div>
            <div class="form-group">
                  <label>phone</label>
                  <input type="text" v-model="form.phone"  maxlength="191" />
            </div>
            <div class="form-group">
                  <label>birthdate</label>
                  <input type="number" v-model="form.birthdate"/>
            </div>
            <div class="form-group">
                  <label>account_status</label>
                  <input type="number" v-model="form.account_status"/>
            </div>
        
            <div class="form-group">
                <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
            </div>
          </form>
          
        </div><!-- End first half -->
        
        <div class="half">
          
          <h1>List users</h1>
          
          <ul v-if="users.length > 0">
            <li v-for="(user,index) in users" :key="user.id">
              
            <router-link :to="'/user/'+user.id">
              
              user {{ index }} {{ user.name }}

              <button @click.prevent="deleteUser(user,index)" type="button" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
              
            </router-link>
              
            </li>
          </ul>
          
          <span v-else-if="!users">Loading...</span>
          <span v-else>No users exist</span>
          
        </div><!-- End 2nd half -->
        
      </div>
</template>

<script>
import { Form } from 'vform'
import { HasError } from 'vform/src/components/tailwind'

export default {
  name: 'User',
  components: {HasError},
  data: function(){
    return {
      users : false,
      form: new Form({
          "id" : "",
          "name" : "",
          "email" : "",
          "email_verified_at" : "",
          "password" : "",
          "is_admin" : "",
          "remember_token" : "",
          "created_at" : "",
          "updated_at" : "",
          "address" : "",
          "phone" : "",
          "birthdate" : "",
          "account_status" : "",
      })
    }
  },
  created: function(){
    this.listUsers();
  },
  methods: {
    listUsers: function(){
      
      var that = this;
      this.form.get('/api/users').then(function(response){
        that.users = response.data;
      })
      
    },
    createUser: function(){
      
      var that = this;
      this.form.post('/api/users').then(function(response){
        that.users.push(response.data);
      })
      
    },
    deleteUser: function(user, index){
      
      var that = this;
      this.form.delete('/api/users/'+user.id).then(function(response){
        that.users.splice(index,1);
      })
      
    }
  }
}
</script>

<style>
.users {
  margin: 0 auto;
  width: 700px;
  display: flex;
}
.users .half {
  flex: 1;
}
.users .half:first-of-type {
  margin-right: 20px;
}
.users form .form-group {
  margin-bottom: 20px;
}
.users form .form-group label {
  display: block;
  margin-bottom: 5px;
  text-transform: capitalize;
}
.users form .form-group input[type="text"],
.users form .form-group input[type="number"],
.users form .form-group textarea {
  width: 100%;
  max-width: 100%;
  min-width: 100%;
  padding: 10px;
  border-radius: 3px;
  border: 1px solid silver;
  font-size: 1rem;
}
.users form .form-group input[type="text"]:focus,
.users form .form-group input[type="number"]:focus,
.users form .form-group textarea:focus {
  outline: 0;
  border-color: blue;
}
.users form .form-group .invalid-feedback {
  color: red;
}
.users form .form-group .invalid-feedback::first-letter {
  text-transform: capitalize;
}
.users form .button {
  appearance: none;
  background: #3bdfd9;
  font-size: 1rem;
  border: 0px;
  padding: 10px 20px;
  border-radius: 3px;
  font-weight: bold;
}
.users form .button:hover {
  cursor: pointer;
  background: #20c7c1;
}
</style>