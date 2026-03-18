<script setup lang="ts">
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { useAppearance } from '@/composables/useAppearance'

const { appearance, activeIcon, options, updateAppearance } = useAppearance()
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger
      class="inline-flex items-center justify-center rounded-sm border border-transparent p-1.5 text-sm text-muted-foreground hover:border-border hover:text-foreground"
    >
      <component :is="activeIcon" class="size-4" />
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuRadioGroup :model-value="appearance" @update:model-value="updateAppearance">
        <DropdownMenuRadioItem v-for="{ value, Icon, label } in options" :key="value" :value="value">
          <component :is="Icon" class="mr-2 size-4" />
          {{ label }}
        </DropdownMenuRadioItem>
      </DropdownMenuRadioGroup>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
