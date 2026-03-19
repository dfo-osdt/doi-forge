<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Spinner } from '@/components/ui/spinner'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { logout } from '@/routes'
import { send } from '@/routes/verification'

defineProps<{
  status?: string
}>()

const { t } = useI18n()
</script>

<template>
  <AuthLayout
    :title="t('auth.verify-email.title')"
    :description="t('auth.verify-email.description')"
  >
    <Head :title="t('auth.verify-email.head')" />

    <div
      v-if="status === 'verification-link-sent'"
      class="mb-4 text-center text-sm font-medium text-green-600"
    >
      {{ t('auth.verify-email.verification-sent') }}
    </div>

    <Form
      v-slot="{ processing }"
      v-bind="send.form()"
      class="space-y-6 text-center"
    >
      <Button :disabled="processing" variant="secondary">
        <Spinner v-if="processing" />
        {{ t('auth.verify-email.resend') }}
      </Button>

      <TextLink
        :href="logout()"
        as="button"
        class="mx-auto block text-sm"
      >
        {{ t('auth.verify-email.log-out') }}
      </TextLink>
    </Form>
  </AuthLayout>
</template>
