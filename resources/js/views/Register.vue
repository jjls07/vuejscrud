<template>
    <div>
        <h1>Create a User</h1>
        <div v-if="message" class="alert">{{ message }}</div>
        <form @submit.prevent="onSubmit($event)">
          <div class="form-group">
              <label for="user_name">Name</label>
              <input id="user_name" v-model="register.name" />
          </div>
          <div class="form-group">
              <label for="user_email">Email</label>
              <input id="user_email" type="email" v-model="register.email" />
          </div>
          <div class="form-group">
              <label for="user_password">Password</label>
              <input id="user_password" type="password" v-model="register.password" />
          </div>
          <div class="form-group">
              <label for="user_repeat_password">Repeat Password</label>
              <input id="user_repeat_password" type="password" v-model="register.repeatpassword"/>
          </div>
          <div class="form-group">
              <button type="submit" :disabled="saving">
                  {{ saving ? 'Registering...' : 'Register' }}
              </button>
              <button type="reset">Reset</button>
          </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            saving: false,
            message: false,
            register: {
                name: '',
                email: '',
                password: '',
                repeatpassword: '',
            }
        }
    },
    methods: {
        onSubmit($event) {
            this.saving = true
            this.message = false
            api.create(this.register)
                .then((response) => {
                    this.message = 'Your user was created.';
                    this.$router.push({ name: 'home' });
                })
                .catch((e) => {
                    this.message = e.response.data.message || 'There was an issue creating the user.';
                })
                .then(() => this.saving = false)
        }
    }
  }
</script>
<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);

.form-group {
    margin-bottom: 1em;
    label {
        display: block;
    }
}
.alert {
    background: $red;
    color: $darkRed;
    padding: 1rem;
    margin-bottom: 1rem;
    width: 50%;
    border: 1px solid $darkRed;
    border-radius: 5px;
}
</style>
