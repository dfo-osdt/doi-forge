<script setup lang="ts">
import type { User } from '@/types'
import { Link, router, usePage } from '@inertiajs/vue3'
import { Globe, LogOut, Settings } from 'lucide-vue-next'
import { computed } from 'vue'
import { update as updateLocale } from '@/actions/App/Http/Controllers/LocaleController'
import {
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuSeparator,
  DropdownMenuSub,
  DropdownMenuSubContent,
  DropdownMenuSubTrigger,
} from '@/components/ui/dropdown-menu'
import UserInfo from '@/components/UserInfo.vue'
import { logout } from '@/routes'
import { edit } from '@/routes/profile'

interface Props {
  user: User
}

defineProps<Props>()

const page = usePage()
const currentLocale = computed(() => page.props.locale)

const locales = [
  { value: 'en', label: 'English' },
  { value: 'fr', label: 'Français' },
]

function switchLocale(locale: string) {
  router.patch(updateLocale().url, { locale })
}

function handleLogout() {
  router.flushAll()
}
</script>

<template>
  <DropdownMenuLabel class="p-0 font-normal">
    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
      <UserInfo :user="user" :show-email="true" />
    </div>
  </DropdownMenuLabel>
  <DropdownMenuSeparator />
  <DropdownMenuGroup>
    <DropdownMenuItem :as-child="true">
      <Link class="block w-full cursor-pointer" :href="edit()" prefetch>
        <Settings class="mr-2 h-4 w-4" />
        Settings
      </Link>
    </DropdownMenuItem>
    <DropdownMenuSub>
      <DropdownMenuSubTrigger>
        <Globe class="mr-2 h-4 w-4" />
        Language
      </DropdownMenuSubTrigger>
      <DropdownMenuSubContent>
        <DropdownMenuRadioGroup :model-value="currentLocale" @update:model-value="switchLocale">
          <DropdownMenuRadioItem v-for="locale in locales" :key="locale.value" :value="locale.value">
            {{ locale.label }}
          </DropdownMenuRadioItem>
        </DropdownMenuRadioGroup>
      </DropdownMenuSubContent>
    </DropdownMenuSub>
  </DropdownMenuGroup>
  <DropdownMenuSeparator />
  <DropdownMenuItem :as-child="true">
    <Link
      class="block w-full cursor-pointer"
      :href="logout()"
      as="button"
      data-test="logout-button"
      @click="handleLogout"
    >
      <LogOut class="mr-2 h-4 w-4" />
      Log out
    </Link>
  </DropdownMenuItem>
</template>
