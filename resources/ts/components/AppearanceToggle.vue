<script setup lang="ts">
import type { AcceptableValue } from 'reka-ui'
import type { Appearance } from '@/types'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { useAppearance } from '@/composables/useAppearance'

const { appearance, activeIcon, options, updateAppearance } = useAppearance()

// reka-ui types the radio group's payload as the non-generic `AcceptableValue`,
// so it cannot know this group only ever emits an `Appearance`.
function selectAppearance(value: AcceptableValue) {
  updateAppearance(value as Appearance)
}
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger
      class="inline-flex items-center justify-center rounded-sm border border-transparent p-1.5 text-sm text-muted-foreground hover:border-border hover:text-foreground"
    >
      <component :is="activeIcon" class="size-4" />
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuRadioGroup :model-value="appearance" @update:model-value="selectAppearance">
        <DropdownMenuRadioItem v-for="{ value, Icon, label } in options" :key="value" :value="value">
          <component :is="Icon" class="mr-2 size-4" />
          {{ label }}
        </DropdownMenuRadioItem>
      </DropdownMenuRadioGroup>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
