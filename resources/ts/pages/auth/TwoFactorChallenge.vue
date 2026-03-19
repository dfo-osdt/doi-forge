<script setup lang="ts">
import type { TwoFactorConfigContent } from '@/types'
import { Form, Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'
import InputError from '@/components/InputError.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
  InputOTP,
  InputOTPGroup,
  InputOTPSlot,
} from '@/components/ui/input-otp'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { store } from '@/routes/two-factor/login'

const { t } = useI18n()

const showRecoveryInput = ref<boolean>(false)
const code = ref<string>('')

const authConfigContent = computed<TwoFactorConfigContent>(() => {
  if (showRecoveryInput.value) {
    return {
      title: t('auth.two-factor.recovery-title'),
      description: t('auth.two-factor.recovery-description'),
      buttonText: t('auth.two-factor.recovery-toggle'),
    }
  }

  return {
    title: t('auth.two-factor.code-title'),
    description: t('auth.two-factor.code-description'),
    buttonText: t('auth.two-factor.code-toggle'),
  }
})

function toggleRecoveryMode(clearErrors: () => void): void {
  showRecoveryInput.value = !showRecoveryInput.value
  clearErrors()
  code.value = ''
}
</script>

<template>
  <AuthLayout
    :title="authConfigContent.title"
    :description="authConfigContent.description"
  >
    <Head :title="t('auth.two-factor.head')" />

    <div class="space-y-6">
      <template v-if="!showRecoveryInput">
        <Form
          v-slot="{ errors, processing, clearErrors }"
          v-bind="store.form()"
          class="space-y-4"
          reset-on-error
          @error="code = ''"
        >
          <input type="hidden" name="code" :value="code">
          <div
            class="flex flex-col items-center justify-center space-y-3 text-center"
          >
            <div class="flex w-full items-center justify-center">
              <InputOTP
                id="otp"
                v-model="code"
                :maxlength="6"
                :disabled="processing"
                autofocus
              >
                <InputOTPGroup>
                  <InputOTPSlot
                    v-for="index in 6"
                    :key="index"
                    :index="index - 1"
                  />
                </InputOTPGroup>
              </InputOTP>
            </div>
            <InputError :message="errors.code" />
          </div>
          <Button type="submit" class="w-full" :disabled="processing">
            {{ t('auth.two-factor.continue') }}
          </Button>
          <div class="text-center text-sm text-muted-foreground">
            <span>{{ t('auth.two-factor.or-you-can') }} </span>
            <button
              type="button"
              class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
              @click="() => toggleRecoveryMode(clearErrors)"
            >
              {{ authConfigContent.buttonText }}
            </button>
          </div>
        </Form>
      </template>

      <template v-else>
        <Form
          v-slot="{ errors, processing, clearErrors }"
          v-bind="store.form()"
          class="space-y-4"
          reset-on-error
        >
          <Input
            name="recovery_code"
            type="text"
            :placeholder="t('auth.two-factor.placeholder-recovery')"
            :autofocus="showRecoveryInput"
            required
          />
          <InputError :message="errors.recovery_code" />
          <Button type="submit" class="w-full" :disabled="processing">
            {{ t('auth.two-factor.continue') }}
          </Button>

          <div class="text-center text-sm text-muted-foreground">
            <span>{{ t('auth.two-factor.or-you-can') }} </span>
            <button
              type="button"
              class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
              @click="() => toggleRecoveryMode(clearErrors)"
            >
              {{ authConfigContent.buttonText }}
            </button>
          </div>
        </Form>
      </template>
    </div>
  </AuthLayout>
</template>
