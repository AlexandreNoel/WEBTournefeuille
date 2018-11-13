<template>
  <v-flex xs12 lg8 xl6>
    <v-hover>
      <v-card
        slot-scope="{ hover }"
        :class="`elevation-${hover ? 12 : 2}`"
        class="mx-auto"
      >
        <div @click="$emit('clicked', id)">

          <v-img
            :aspect-ratio="16/9"
            :src="`https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${photoReference}&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo`"
          ></v-img>

          <v-card-title>
            <div>
              <span class="headline">{{ name }}</span>

              <div class="d-flex">
                <v-rating
                  :value="rating"
                  color="amber"
                  dense
                  half-increments
                  readonly
                  size="14"
                ></v-rating>

                <div class="ml-2 grey--text text--darken-2">
                  <span>1</span>
                  <span>({{ name.length }})</span>
                </div>
              </div>
            </div>
          </v-card-title>
        </div>
        <v-card-actions>
          <v-btn icon @click="$emit('black', bar)">
            <v-icon>block</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn icon @click="$emit('liked', bar);isFull=true">
            <v-icon v-if="!isFull">favorite_border</v-icon>
            <v-icon v-if="isFull">favorite</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>

    </v-hover>
  </v-flex>
</template>

<script>
export default {
  name: 'AddBar',

  props: {
    id: {
      type: Number,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    photoReference: {
      type: String,
      required: true
    },
    rating: {
      type: Number,
      required: true
    },
    lat: {
      type: String,
      required: true
    },
    lng: {
      type: String,
      required: true
    },
    placeId: {
      type: String,
      required: true
    },
    address: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      isFull: false
    }
  },

  computed: {
    bar () {
      return {
        id: this.id,
        name: this.name,
        photoReference: this.photoReference,
        rating: this.rating,
        placeId: this.placeId,
        lat: this.lat,
        lng: this.lng,
        address: this.address
      }
    }
  }
}
</script>
