<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import InputError from '@/components/InputError.vue'
import PasswordInput from '@/components/PasswordInput.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Spinner } from '@/components/ui/spinner'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { update } from '@/routes/password'

const props = defineProps<{
  token: string
  email: string
}>()

const inputEmail = ref(props.email)
const { t } = useI18n()
</script>

<template>
  <AuthLayout
    :title="t('auth.reset-password.title')"
    :description="t('auth.reset-password.description')"
  >
    <Head :title="t('auth.reset-password.head')" />

    <Form
      v-slot="{ errors, processing }"
      v-bind="update.form()"
      :transform="(data) => ({ ...data, token, email })"
      :reset-on-success="['password', 'password_confirmation']"
    >
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Label for="email">{{ t('auth.reset-password.email') }}</Label>
          <Input
            id="email"
            v-model="inputEmail"
            type="email"
            name="email"
            autocomplete="email"
            class="mt-1 block w-full"
            readonly
          />
          <InputError :message="errors.email" class="mt-2" />
        </div>

        <div class="grid gap-2">
          <Label for="password">{{ t('auth.reset-password.password') }}</Label>
          <PasswordInput
            id="password"
            name="password"
            autocomplete="new-password"
            class="mt-1 block w-full"
            autofocus
            :placeholder="t('auth.reset-password.password')"
          />
          <InputError :message="errors.password" />
        </div>

        <div class="grid gap-2">
          <Label for="password_confirmation">
            {{ t('auth.reset-password.confirm-password') }}
          </Label>
          <PasswordInput
            id="password_confirmation"
            name="password_confirmation"
            autocomplete="new-password"
            class="mt-1 block w-full"
            :placeholder="t('auth.reset-password.confirm-password')"
          />
          <InputError :message="errors.password_confirmation" />
        </div>

        <Button
          type="submit"
          class="mt-4 w-full"
          :disabled="processing"
          data-test="reset-password-button"
        >
          <Spinner v-if="processing" />
          {{ t('auth.reset-password.button') }}
        </Button>
      </div>
    </Form>
  </AuthLayout>
</template>
