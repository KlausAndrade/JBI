<template>
  <tw-card class="mx-auto">
    <section id="houses-create" class="bg-white border-b py-8">
      <div class="container mx-auto flex flex-wrap pt-4 pb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
          {{ $t('edit') }}
        </h1>
        <div class="w-full mb-4">
          <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t" />
        </div>
      </div>

      <house-form :house-id="this.$route.params.id" type="edit" />
    </section>
  </tw-card>
</template>

<script>
import HouseForm from './house-form'
export default {
    name: 'Edit',
    components: { HouseForm }

}
</script>

<style scoped>

</style>
