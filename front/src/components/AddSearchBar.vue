<template>
  <v-toolbar color="transparent" flat>
    <v-text-field
      :value="value"
      label="Un nom de bar"
      @input="$emit('input', $event)"
      @keyup.enter="$emit('search', value)"
      clearable
      solo
    ></v-text-field>

    <v-btn
      large
      color="secondary"
      @click="$emit('search', value)"
      v-text="'J\'ai soif !'"
    ></v-btn>
  </v-toolbar>
</template>

<script>
export default {
  name: 'AddSearchBar',

  props: {
    value: {
      type: String,
      required: true
    }
  }
}
</script>
