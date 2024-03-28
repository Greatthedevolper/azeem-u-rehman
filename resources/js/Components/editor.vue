<script setup>
import Editor from '@tinymce/tinymce-vue'
</script>

<template>
  <main id="sample">
    <Editor
    api-key="joakk2mf4d59kshnz749gd16kl2gtlpffssy1m4zpb9phcih"
      :init="{
        plugins: 'lists link image table code help wordcount'
      }"
    />
  </main>
</template>

<style scoped>
.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  #sample {
    display: flex;
    flex-direction: column;
    place-items: center;
    width: 1000px;
  }
}
</style>
