<template>
  <v-flex xs12 sm6 md4 xl3 @click="$emit('clicked', id)">
    <v-hover>
      <v-card
        slot-scope="{ hover }"
        :class="`elevation-${hover ? 12 : 2}`"
        class="mx-auto"
      >
        <v-img
          :aspect-ratio="16/9"
          :src="`https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${photoReference}&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo`"
        ></v-img>

        <v-card-title>
          <div>
            <span class="headline">{{ name }}</span>

            <div>
              <v-chip
                v-for="(keyword, i) in keywords"
                :key="i"
              >{{ keyword.name }}</v-chip>
            </div>

            <div class="d-flex">
              <v-rating
                  v-model="rating"
                  color="yellow darken-3"
                  background-color="grey darken-1"
                  empty-icon="$vuetify.icons.ratingFull"
                  half-increments
                  hover
                  size="15"
                  readonly
                ></v-rating>
            </div>
          </div>
        </v-card-title>
      </v-card>
    </v-hover>
  </v-flex>
</template>

<script>
export default {
  name: 'Bar',

  props: {
    id: {
      type: Number,
      required: true
    },

    name: {
      type: String,
      required: true
    },

    address: {
      type: String,
      required: true
    },

    keywords: {
      type: Array
    },

    photoReference: {
      type: String,
      required: true
    },

    rating: {
      type: Number,
      required: true
    }
  }
}
</script>
