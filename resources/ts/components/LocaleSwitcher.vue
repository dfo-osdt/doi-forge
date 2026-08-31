<script setup lang="ts">
import type { AcceptableValue } from 'reka-ui'
import { router, usePage } from '@inertiajs/vue3'
import { Globe } from '@lucide/vue'
import { computed } from 'vue'
import { update as updateLocale } from '@/actions/App/Http/Controllers/LocaleController'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

const page = usePage()
const currentLocale = computed(() => page.props.locale)

const locales = [
  { value: 'en', label: 'English' },
  { value: 'fr', label: 'Français' },
]

// reka-ui types the radio group's payload as the non-generic `AcceptableValue`,
// so it cannot know this group only ever emits one of `locales`.
function switchLocale(locale: AcceptableValue) {
  router.patch(updateLocale().url, { locale: locale as string })
}
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger
      class="inline-flex items-center justify-center rounded-sm border border-transparent p-1.5 text-sm text-muted-foreground hover:border-border hover:text-foreground"
    >
      <Globe class="size-4" />
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuRadioGroup :model-value="currentLocale" @update:model-value="switchLocale">
        <DropdownMenuRadioItem v-for="locale in locales" :key="locale.value" :value="locale.value">
          {{ locale.label }}
        </DropdownMenuRadioItem>
      </DropdownMenuRadioGroup>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
