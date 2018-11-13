<template>
  <v-layout>
    <v-flex xs4>
      <v-img
        :src="`https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${photoReference}&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo`"
        height="200px"
        contain
        class="ml-2"
      ></v-img>
    </v-flex>
    <v-flex xs7>
      <v-card-title primary-title>
        <v-card-actions class="display-1">
          <v-spacer></v-spacer>
        </v-card-actions>
        <div class="headline">Mots clefs:</div>
        <div>
          <v-chip
            v-for="keyword in keywords"
            :key="keyword.id"
            outline color="green darken-1"
          >
            {{ keyword.name }}
          </v-chip>
          <v-rating
            v-model="rating"
            color="yellow darken-3"
            background-color="grey darken-1"
            empty-icon="$vuetify.icons.ratingFull"
            half-increments
            hover
            readonly
          ></v-rating>
        </div>
      </v-card-title>
    </v-flex>
  </v-layout>
</template>
<script>
export default {
  name: 'BarInfo',

  props: {
    keywords: {
      type: Array,
      required: true
    },

    rating: {
      type: Number,
      required: true
    },
    photoReference: {
      type: String,
      required: true
    }

  }
}
</script>
