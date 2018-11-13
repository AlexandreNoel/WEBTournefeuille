<template>
  <v-toolbar color="transparent" flat>
    <v-autocomplete
      :value="value"
      @input="$emit('input', $event)"
      :items="keywords"
      item-text="name"
      label="Ce que j'aimerais"
      multiple
      hide-no-data
      hide-details
      clearable
      solo
    ></v-autocomplete>

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
  name: 'SearchBar',

  props: {
    keywords: {
      type: Array,
      required: true
    },
    value: {
      type: Array,
      required: true
    }
  }
}
</script>
