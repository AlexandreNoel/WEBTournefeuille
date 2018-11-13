<template>
  <v-card class="pa-4 mt-3">
    <div class="loader" v-show="loading2" >
      <span class="spinner"></span>
    </div>
    <v-form  ref="signup" lazy-validation>
      <v-textarea
        v-model="comment.content"
        class="input-message"
        outline
        label="Donnez votre avis!"
        name="message"
        id="message"
        rows="3"
        required
      ></v-textarea>
      <v-layout justify-end>
        <v-btn
          :disabled="loading2"
          large
          color="secondary"
          @click="$emit('submit', comment)"
          v-text="'Commenter'"
        ></v-btn>
      </v-layout>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: 'CommentForm',
  data () {
    return {
    }
  },
  props: {
    comment: {
      type: Object,
      required: true
    },
    loading2: Boolean
  }
}
</script>

<style>

</style>
