<template>
  <div>
    <section id="services" class="bg-white border-b py-8">
      <div class="container mx-auto flex flex-wrap pt-4 pb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
          {{ $t('services') }}
        </h1>
        <div class="w-full mb-4">
          <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t" />
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_one') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_one') }}
            </p>
          </div>
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <p class="w-full text-gray-600 text-xs md:text-sm px-6">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_two') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_two') }}
            </p>
          </div>
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <p class="w-full text-gray-600 text-xs md:text-sm px-6">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_three') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_three') }}
            </p>
          </div>
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_four') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_four') }}
            </p>
          </div>
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <p class="w-full text-gray-600 text-xs md:text-sm px-6">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_five') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_five') }}
            </p>
          </div>
        </div>

        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
          <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
            <div class="w-full font-bold text-xl text-gray-800 px-6 text-center mb-4">
              {{ $t('services_title_six') }}
            </div>
            <p class="text-gray-800 text-base px-6 mb-5">
              {{ $t('services_content_six') }}
            </p>
          </div>
        </div>
      <div class="bg-white mx-auto pb-8 px-6 rounded shadow text-center mt-4">
        <h4 class="font-bold text-xl my-4">{{ $t('services_individual_header') }}</h4>
        <p class="max-w-3xl">{{ $t('services_individual_content') }}</p>
      </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {}
</script>
