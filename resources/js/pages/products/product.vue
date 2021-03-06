<template>
  <div id="product" v-if="$store.getters['auth/role'] || product.active" :class="size" class="" style="min-width: 300px;">
    <div class="flex items-center justify-center">
      <div class="w-full sm:w-full lg:w-full py-6 px-3">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
          <div class="relative h-56 overflow-hidden">
            <div v-if="$store.getters['auth/role']" class="text-right absolute z-30 right-0 top-0 px-1 m-1 bg-white shadow" title="Show or hide product for customers">
              <input v-model="product.active" type="checkbox" @click="updateActive(product)">
            </div>
            <vue-carousel v-if="images.length > 0" :data="images" />

            <div v-else class="bg-cover bg-center h-56 p-4" style="background-image: url(https://via.placeholder.com/450x450)" />
          </div>
          <div class="p-4">
            <p class="uppercase tracking-wide text-sm font-bold text-gray-700">
              {{ product.name }}
            </p>
            <p class="text-3xl text-gray-900" v-if="product.price > 0">
              €{{ product.price | currency }}
            </p>
          </div>
          <div class="p-4 border-t border-gray-300 text-gray-700">
            <div class="text-gray-700" v-html="description">
              No description
            </div>
            <p v-if="hasViewMore" class="cursor-pointer text-blue-500 mt-2" @click="viewMore = !viewMore">
              {{ $t('read_more') }}
            </p>
          </div>
          <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
            <div class="flex items-center justify-center pt-2">
             <router-link class="font-bold ml-4" :to="{name: 'products.show', params: { id: product.id }}">
                <TwButton>{{ $t('read_more') }}</TwButton>
              </router-link>

              <router-link v-if="$store.getters['auth/role']" class="font-bold ml-4" :to="{name: 'products.edit', params: { id: product.id }}">
                {{ $t('edit') }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TwButton from '../../components/TwButton'
import axios from 'axios'
import VueCarousel from '@chenfengyuan/vue-carousel'

export default {
  name: 'Product',
  components: { TwButton, VueCarousel },
  filters: {
    currency (value) {
      return value.toFixed(2)
    }
  },
  props: {
    product: { required: true },
    size: { default: 'max-w-6xl w-full md:w-1/3' }
  },
  data () {
    return {
      viewMore: false,
      images: this.product.image.map((image) => `<img src="${image.url}" />`)
    }
  },
  computed: {
    description () {
      if (this.product.description.length > 80 && !this.viewMore) {
        return this.product.description.substring(0, 80) + '...'
      }

      return this.product.description
    },
    hasViewMore () {
      return this.product.description.length > 80
    }
  },
  methods: {

    async updateActive (product) {
      let reqObject = { id: product.id, active: !product.active }
      try {
        await axios.patch('/api/products/updateActive', reqObject)
      } catch (error) {
        this.error = this.$t('product_not_found')
      }
    }

  }
}
</script>

<style>
  #product h1{
    font-size: 32px;
    font-weight: bold;
  }
  h2{
    font-size: 28px;
    font-weight: bold;
  }
  h3{
    font-size: 24px;
    font-weight: bold;
  }
</style>
