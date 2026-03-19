<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue'
</script>

<template>
  <div class="flex aspect-square size-10 items-center justify-center rounded-md bg-primary group-data-[collapsible=icon]:size-8">
    <AppLogoIcon class="size-6 text-primary-foreground group-data-[collapsible=icon]:size-4" />
  </div>
  <div class="ml-1 grid flex-1 text-left group-data-[collapsible=icon]:hidden">
    <span class="truncate font-serif text-lg leading-tight font-semibold">DOI Forge</span>
    <span class="truncate font-mono text-xs text-muted-foreground/50">10.XXXX/doi-forge</span>
  </div>
</template>
